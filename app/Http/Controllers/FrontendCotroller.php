<?php

namespace App\Http\Controllers;


use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\Return_;
use PHPUnit\Event\Code\Throwable;

use function Laravel\Prompts\error;
use function PHPUnit\Framework\isEmpty;

class FrontendCotroller extends Controller
{
    public function login(Request $request)
    {
       // try {

            $response = Http::retry(3, 1000)
                ->timeout(60000)->post(env('APIGATEWAY_SERVICE_URL') . '/api/v1/auth/login', $request->all());
            session(['api_token' => $response['access_token']]);
            return redirect()->route('index');
        // } catch (Exception $e) {
        //     $error = 1;
        //     return view('auth.login')->with('error', $error);
        // }
    }

    public function index()
    {

        // obtener el token generado y guardado en la sesion
        $token = session('api_token');
        //try catch para el manejo de errores al ejecutar la solicitud http a los endpoints
        try {
            // solicita los productos con poco stock al endpoint
            $chartResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products/low');
            $chartResponse = $chartResponse->json(); // los convierte en json
            // solicita la informacion del usuario que inicio sesion
            $userInfoResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/auth/me');
            $userInfoResponse = $userInfoResponse->json(); // se parsea a formato json

            $name = $userInfoResponse['name']; // se obtiene el nombre del usuario autenticado
            $labels = array_column($chartResponse, 'name'); // los datos arrojados por el endpoint de productos bajos se guardan en un array esto para ser mostrados como charts en la vista index
            $data = array_column($chartResponse, 'quantity'); // los datos arrojados por el endpoint de productos bajos se guardan en un array esto para ser mostrados como charts en la vista index

            // retorna la vista index con los datos obtenidos de los endpoints
            return view('index', compact('labels', 'data'))->with('name', $name);
        } catch (\Throwable $th) { // en caso de que el token haya expirado y ocurra un error debido a ello se retornara la vista login con un mesaje de error para que el usuario pueda volver a inciar sesion.
            $error = 2; // error 2 "sesion expirada"
            return view('auth.login')->with('error', $error); // se retorna la vista login con el manejo de errores
        }
    }

    /**
     * Display the specified resource.
     */


    public function logout()
    {
        $token = session('api_token'); //recuperar el token de la sesion actual

        try {
            $logoutResponse =  Http::withToken($token)->timeout(600)->post(env('APIGATEWAY_SERVICE_URL') . '/api/v1/auth/logout'); // solicitar el cierre de sesion del usuario
            if ($logoutResponse->successful()) { // si la respuesta es exitosa se elimina el token de la sesion
                $error = 0; // variable para no mostrar errores en la vista de login
                $token = ''; //inicializacion de la varable token vacia 
                session(['api_token' => $token]); //hacemos que el token de la sesion sea igual a la variable token esto para borrar el token de la sesion
                return view('auth.login')->with('error', $error); //retorno de la vista login
            }
        } catch (Exception $e) { // en caso de que falle el cierre de sesion lo importante sera que se elimine el token de la sesion el proceso es el mismo que en el try
            $error = 0;
            $token = '';
            session(['api_token' => $token]);
            return view('auth.login')->with('error', $error);
        }
    }

    public function register(Request $request)
    {
        $pasword = $request->input('password');
        $confirmPassword = $request->input('confirmPassword');
        $error = 0;

        $headers = [
            'Conetent-Type' => 'application/json',
        ];

        if ($pasword != $confirmPassword) {
            $error = 1;
            return view('auth.register')->with('error', $error);
        }
        if (strlen($pasword) < 8) {
            $error = 2;
            return view('auth.register')->with('error', $error);
        }

        try {
            $registerResponse = Http::withHeaders($headers)
                ->timeout(600)->post(env('APIGATEWAY_SERVICE_URL') . '/api/v1/auth/register', [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'rol' => 'cliente'
                ]);

            $error = 3;
            return view('auth.register')->with('error', $error);
        } catch (Exception $ex) {
        }
    }


    public function products()
    {
            $token = session('api_token');
            $error = 0;

            // Lanza una excepción si ocurre un error en la petición HTTP
            $products = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products');


            return view('products.products')->with('products', $products->json())->with('error', $error);
    }

    public function deleteProduct(Request $request)
    {
        try {
            $token = session('api_token');

            $id = $request->input('id');

            $deleteResponse = Http::withToken($token)->timeout(600)->delete(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products/' . $id)
                ->throw()->json();

            $productResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products')
                ->throw()->json();
            $error = 1;
            return view('products.products')->with('error', $error)->with('products', $productResponse);
        } catch (\Throwable $th) {
            $error = 0; // Cambiar el valor del error para diferenciar
            return view('auth.login')->with('error', $error);
        }
    }

    public function storeProduct(Request $request)
    {

        $token = session('api_token');
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application /json',
        ];

        $ingredients = $request->input('ingredients');
        $ingredients = explode(",", $ingredients);

        $product = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'quantity' =>  intval($request->input('quantity')),
            'ingredients' => $ingredients,
            'available' => true
        ];

        $storeResponse = Http::withHeaders($headers)->timeout(600)->post(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products/store', $product);
        $productResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products');
        $error = 3;
        return view('products.products')->with('error', $error)->with('products', $productResponse->json());
    }

    public function updateProduct(Request $request)
    {
        $token = session('api_token');
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application /json',
        ];

        $id = $request->input('id');
        $ingredients = $request->input('ingredients');
        $ingredients = explode(",", $ingredients);

        $product = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'quantity' => intval($request->input('quantity')),
            'ingredients' => $ingredients,
            'available' => true
        ];

        $updateResponse = Http::withHeaders($headers)->timeout(600)->put(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products/' . $id, $product);
        $productResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products');
        $error = 3;
        return view('products.products')->with('products', $productResponse->json())->with('error', $error);
    }


    public function Orders()
    {
        $token = session('api_token');
        $orders = [];
        $products = [];
        $error = 0;

        // Obtener productos
        $products = $this->fetchProducts($token);

        // Obtener órdenes
        $orders = $this->fetchOrders($token);

        if (empty($orders) && empty($products)) {
            return view('orders.orderEmpty');
        }
        // Si no hay órdenes pero hay productos
        if (empty($orders)) {
            return view('orders.orderEmptyOrders')->with('error', $error)->with('products', $products);
        }

        return view('orders.orders')->with('orders', $orders)->with('error', $error)->with('products', $products);
    }

    /**
     * Obtiene y procesa los productos.
     */
    private function fetchProducts($token)
    {
        $response = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products');
        $products = [];
        if (!$response->successful()) {
            return $products;
        }

        $dataProduct = json_decode($response->body(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return;
        }

        foreach ($dataProduct as $product) {
            $products[] = [
                'id' => $product['_id']['$oid'],
                'name' => $product['name'],
            ];
        }

        return $products;
    }

    /**
     * Obtiene y procesa las órdenes.
     */
    private function fetchOrders($token)
    {
        $response = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/orders');
        $orders = [];
        if (!$response->successful()) {
            return $orders;
        }

        $data = json_decode($response->body(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return;
        }

        foreach ($data as $order) {
            $orders[] = [
                'Order_id' => $order['_id']['$oid'],
                'Customer_name' => $order['customer_name'],
                'Product_name' => $order['items'][0]['name'],
                'Fecha de creacion' => $order['created_at'],
                'Estado' => $order['status'],
                'Total' => $order['total_price'],
                'quantity' => $order['items'][0]['quantity'],
                'product_id' => $order['items'][0]['product_id'],
            ];
        }

        return $orders;
    }

    public function deleteOrder(Request $request)
    {

        $token = session('api_token');

        $id = $request->input('id');
        $deleteResponse = Http::withToken($token)->timeout(600)->delete(env('APIGATEWAY_SERVICE_URL') . '/api/v1/orders/' . $id);
        $orders = $this->fetchOrders($token);
        $products = $this->fetchProducts($token);

        if (empty($orders) && empty($products)) {
            $error = 1;
            return view('orders.orderEmpty')->with('error', $error);
        }

        if (empty($orders)) {
            $error = 1;
            return view('orders.orderEmptyOrders')->with('error', $error)->with('products', $products);
        }


        $error = 1;
        return view('orders.orders')->with('orders', $orders)->with('error', $error)->with('products', $products);
    }

    public function updateOrder(Request $request)
    {

        $token = session('api_token');
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];

        $id = $request->input('id');
        $productId = $request->input('newProductId');
        $productResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products/' . $productId);
        $productResponse = json_decode($productResponse, true);


        $product = [
            'product_id' => $productResponse['producto']['_id']['$oid'],
            'name' => $productResponse['producto']['name'],
            'quantity' => intval($request->input('quantity'))

        ];


        $date = $request->input('newDate');
        if ($date == null) {
            $date = $request->input('date');
        } else {
            $date = $request->input('newDate');
        }

        $orderUpdated = [
            'customer_name' => $request->input('Customer_name'),
            'items' => [$product],
            'status' => $request->input('nuevoEstado'),

            'total_price' => intval($request->input('Total'))
        ];

        $updateResponse = Http::withHeaders($headers)->timeout(6000)->put(env('APIGATEWAY_SERVICE_URL') . '/api/v1/orders/' . $id, $orderUpdated);
        // Recorre cada orden y extrae los datos necesarios



        $a = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products'); // solicitar los productos para mostrarlo en el select de la vista
        $dataProduct = json_decode($a, true);

        foreach ($dataProduct as $product) {
            $product_data = [
                'id' => $product['_id']['$oid'],
                'name' => $product['name'],


            ];



            // Agrega los datos extraídos al arreglo final
            $products[] = $product_data;
        }

        $orderResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/orders'); // solicitar las ordenes ya creadas para mostralo en la vista
        $orderResponse->json();
        $data = json_decode($orderResponse, true);
        foreach ($data as $order) {
            $order_data = [
                'Order_id' => $order['_id']['$oid'],
                'Customer_name' => $order['customer_name'],
                'Product_name' => $order['items'][0]['name'],
                'Fecha de creacion' => $order['created_at'],
                'Estado' => $order['status'],
                'Total' => $order['total_price'],
                'quantity' => $order['items'][0]['quantity'],
                'product_id' => $order['items'][0]['product_id']

            ];

            // Agrega los datos extraídos al arreglo final
            $orders[] = $order_data;
        }

        $error = 3;
        return view('orders.orders')->with('orders', $orders)->with('error', $error)->with('products', $products);
    }

    public function storeOrders(Request $request)
    {

        $token = session('api_token');
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];

        //solicitud al enpoind del producto
        $productId = $request->input('product_id');
        $productResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products/' . $productId);
        $productResponse = json_decode($productResponse, true);
        $product = [
            'product_id' => $productResponse['producto']['_id']['$oid'],
            'name' => $productResponse['producto']['name'],
            'quantity' => $request->input('quantity')
        ];


        $order = [
            'customer_name' => $request->input('customer_name'),
            'items' => [$product],
            'total_price' => $request->input('total_price'),
            'status' => $request->input('status')
        ];

        //solicitud al endpoint de crear orden
        $storeResponse = Http::withHeaders($headers)->timeout(6000)->post(env('APIGATEWAY_SERVICE_URL') . '/api/v1/orders/store', $order);
        $orderResponse = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/orders'); // solicitar las ordenes ya creadas para mostralo en la vista
        $orderResponse->json();
        $data = json_decode($orderResponse, true);

        $a = Http::withToken($token)->timeout(600)->get(env('APIGATEWAY_SERVICE_URL') . '/api/v1/products'); // solicitar los productos para mostrarlo en el select de la vista
        $dataProduct = json_decode($a, true);

        foreach ($dataProduct as $product) {
            $product_data = [
                'id' => $product['_id']['$oid'],
                'name' => $product['name'],


            ];



            // Agrega los datos extraídos al arreglo final
            $products[] = $product_data;
        }
        foreach ($data as $order) {
            $order_data = [
                'Order_id' => $order['_id']['$oid'],
                'Customer_name' => $order['customer_name'],
                'Product_name' => $order['items'][0]['name'],
                'Fecha de creacion' => $order['created_at'],
                'Estado' => $order['status'],
                'Total' => $order['total_price'],
                'quantity' => $order['items'][0]['quantity'],
                'product_id' => $order['items'][0]['product_id']

            ];

            // Agrega los datos extraídos al arreglo final
            $orders[] = $order_data;
        }

        $error = 3;
        return view('orders.orders')->with('orders', $orders)->with('error', $error)->with('products', $products);
    }
}
