<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginInfo extends Model
{
    use HasFactory;

    protected $table = "login_infos";
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function getTableColumns()
    {
        return (new static)->getConnection()->getSchemaBuilder()->getColumnListing((new static)->getTable());
    }

    public static function saveInfo($params)
    {

        return LoginInfo::insertGetId([
            'ip_address' => $params->ip(),
            'device_type' => $params->server('SERVER_SOFTWARE') ?? '',
            'browser' => $params->server('SERVER_SOFTWARE') ?? '',
            'user_agent' => $params->header('User-Agent') ?? '',

        ]);
    }
}
