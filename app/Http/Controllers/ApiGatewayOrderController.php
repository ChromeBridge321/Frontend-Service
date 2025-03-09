<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\FuncCall;
class ApiGatewayOrderController extends Controller
{
    public function Order(Request $request){
        try {
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
                ->retry(3, 500)
                ->get(env('ORDER_SERVICE_URL') . '/api/v1/orders');
            return $response->json();
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function storeOrder(Request $request)
    {
        try {
            $headers = [
                'Authorization' => $request->header('Authorization'),
                'Content-Type' => 'application/json'
            ];


            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->post(env('ORDER_SERVICE_URL') . '/api/v1/orders', $request->all());
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function showOrder(string $id, Request $request)
    {

        try {
            $headers = [
                'Authorization' => $request->header('Authorization')
            ];


            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->get(env('ORDER_SERVICE_URL') . '/api/v1/orders/' . "$id");
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function updateOrder(string $id, Request $request)
    {
        try {
            $headers = [
                'Authorization' => $request->header('Authorization'),
                'Content-Type' => 'application/json'
            ];
            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->put(env('ORDER_SERVICE_URL') . '/api/v1/orders/' . "$id", $request->all());
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function deleteOrder(string $id, Request $request)
    {
        try {
            $headers = [
                'Authorization' => $request->header('Authorization'),
            ];
            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->delete(env('ORDER_SERVICE_URL') . '/api/v1/orders/' . "$id");
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
