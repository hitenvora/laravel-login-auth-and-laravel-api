<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function sendresponse($result, $message)
    {

        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }




    public function erroreresponse($errore, $erroremessage = [], $code = 404)
    {

        $response = [
            'success' => false,
            'data' => $errore,

        ];
        if (!empty($erroremessage)) {
            $response['data'] = $erroremessage;
        }
        return response()->json($response, $code);
    }
}
