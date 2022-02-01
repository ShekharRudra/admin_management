<?php

namespace App\Models;
use App\Models\ParameterValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class ParameterValue extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'mst_parameter_value';
    protected $fillable = [
        'parameter_type_id',
        'parameter_value_code',
        'parameter_value',
        'accepted_values',
        'image_link',
        'sequence_no',
        'is_active',
        'remark',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
