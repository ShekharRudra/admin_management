<?php

namespace App\Models;
use App\Models\Learn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Trn_Transaction_Log extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'trn_transaction_log';
    protected $fillable = [
        'type',
        'user_id',
        'category_id',
        'title',
        'amount',
        'status',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

}
