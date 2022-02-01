<?php

namespace App\Models;
use App\Models\Learn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Trn_Income extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'trn_income';
    protected $fillable = [
        'user_id',
        'income_name',
        'planned_amount',
        'note',
        'sequence_no',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
