<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponseController extends Controller
{
    /**
     * Resposta de sucesso.
     *
     * @param  string  $message
     * @param  mixed  $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($message = 'Success', $data = null)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Resposta de erro.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message = 'Error', $statusCode = 500)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }
}
