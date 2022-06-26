<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    //
    public function dataResponse($status, $message, $data = null){
        $code = $status == 'success' ? 200 : 201;
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

}
