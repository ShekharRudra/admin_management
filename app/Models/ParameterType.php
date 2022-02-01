<?php

namespace App\Models;
use App\Models\ParameterType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class ParameterType extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'mst_parameter_type';
    protected $fillable = [
        'parameter_type_name',
        'remark',
        'is_active',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

}
