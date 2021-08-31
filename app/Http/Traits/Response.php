<?php

namespace App\Http\Traits;

trait Response {
    public function sendResponse($message,$code = 200,$data = null)
    { 
    	$response = [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];
        return response()->json($response, $code);
    }  

    public function sendError($message, $code = 400 , $data = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data'    => $data
        ];
        return response()->json($response, $code);

    }
}