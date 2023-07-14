<?php

namespace App\Http\Controllers;

use App\Models\LoginInfo;
use Illuminate\Http\Request;

class LoginInfoController extends Controller
{

    public function saveLoginInfo()
    {
        try {

            $clientData = request();

            $loginInfo = LoginInfo::saveInfo($clientData);
            if (isset($loginInfo['id'])) {
                $array = [
                    'status' => true,
                    'message' =>  "user information is added successfully",
                    'Id' => $loginInfo['id'],
                ];
                return response()->json($array, 200);
                die;
            } else {
                $array = [
                    'status' => false,
                    'message' => "user information creation failed",
                    'data' => [],
                ];
                return response()->json($array, 202);
                die;
            }
        } catch (\Exception $e) {
            $array = [
                'status'  => false,
                'message' => $e->getMessage()
            ];
            return response()->json($array, 500);
            die;
        }
    }
}
