<?php

namespace App\Http\Controllers\Traits;

/**
 * Trait CustomResponse
 * @package App\Http\Controllers\Traits
 */
trait CustomResponse
{

    /**
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data) {

        $response = [
            'code' => 200,
            'status' => 'success',
            'data' => $data 
        ];
        return response()->json($response)->setStatusCode($response['code']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFoundResponse() {

        $response = [
            'code' => 404,
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => 'Not Found'
        ];
        return response()->json($response)->setStatusCode($response['code']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteResponse() {

        $response = [
            'code' => 204,
            'status' => 'success',
            'data' => [],
            'message' => 'Resource Deleted'
        ];
        return response()->json($response)->setStatusCode($response['code']);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($data) {
 
        $response = [
            'code' => 422,
            'status' => 'error',
            'data' => $data,
            'message' => 'Unprocessable Entity'
        ];
        return response()->json($response)->setStatusCode($response['code']);;
    }
}
