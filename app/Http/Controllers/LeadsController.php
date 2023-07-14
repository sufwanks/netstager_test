<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function saveLeadDetails(Request $request)
    {
        try {
            $params = $request->validate([
                'first_name'   => 'required',
                'last_name'  => 'required',
                'day'    => 'required',
                'month'   => 'required',
                'year'  => 'required',
                'email_id'    => 'required',
                'phone_number'    => 'required'
            ]);
            $exist = Leads::checkLeadNameExist($request);
            if ($exist) {
                $array = [
                    'status' => false,
                    'message' => "Lead details already exist",

                ];
                return response()->json($array, 202);
                die;
            }
            $leadDetails = Leads::saveData($request);
            if ($leadDetails) {
                $array = [
                    'status' => true,
                    'message' => "Lead created successfully",
                    'Id' => $leadDetails,
                ];
                return response()->json($array, 200);
                die;
            } else {
                $array = [
                    'status' => false,
                    'message' => "Lead creation failed",
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
