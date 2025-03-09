<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Http;


class ApiGatewayProductcController extends Controller
{
    public function products(Request $request)
    {
        try {
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
                ->retry(3, 500)
                ->get(env('PRODUCTS_SERVICE_URL') . '/api/v1/products');
            return $response->json();
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function storeProduct(Request $request)
    {
        try {
            $headers = [
                'Authorization' => $request->header('Authorization'),
                'Content-Type' => 'application/json'
            ];


            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->post(env('PRODUCTS_SERVICE_URL') . '/api/v1/products', $request->all());
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function showProduct(string $id, Request $request)
    {

        try {
            $headers = [
                'Authorization' => $request->header('Authorization')
            ];


            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->get(env('PRODUCTS_SERVICE_URL') . '/api/v1/products/' . "$id");
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function updateProduct(string $id, Request $request)
    {
        try {
            $headers = [
                'Authorization' => $request->header('Authorization'),
                'Content-Type' => 'application/json'
            ];
            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->put(env('PRODUCTS_SERVICE_URL') . '/api/v1/products/' . "$id", $request->all());
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function deleteProduct(string $id, Request $request)
    {
        try {
            $headers = [
                'Authorization' => $request->header('Authorization'),
            ];
            $response = Http::withHeaders($headers)
                ->timeout(600)
                ->delete(env('PRODUCTS_SERVICE_URL') . '/api/v1/products/' . "$id");
            return $response->json();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function getLowProducts(Request $request){
    {
        try {
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
                ->retry(3, 500)
                ->get(env('PRODUCTS_SERVICE_URL') . '/api/v1/products/low');
            return $response->json();
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }
}
}
