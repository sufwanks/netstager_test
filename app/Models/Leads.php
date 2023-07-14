<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    protected $table = 'leads';
    public $timestamps = false;

    protected $guarded = [];



    protected function checkLeadNameExist($request)
    {
        try {
            $leadExist = Leads::where('first_name', $request['first_name'])
                ->orWhere('phone_number', $request['phone_number'])
                ->orWhere('email_id', $request['email_id'])->first();
            return $leadExist;
        } catch (Throwable $t) {
            throw $t;
        }
    }

    public static function saveData($params)
    {
            // dd($request);

        return Leads::insertGetId([
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'] ?? '',
            'day' => $params['day'] ?? '',
            'month' => $params['month'] ?? '',
            'year' => $params['year'] ?? '',
            'email_id' => $params['email_id'] ?? '',
            'phone_number' => $params['phone_number'] ?? '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
