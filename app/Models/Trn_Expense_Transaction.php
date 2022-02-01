<?php

namespace App\Models;
use App\Models\Learn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Trn_Expense_Transaction extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'trn_expense_transaction';
    protected $fillable = [
        'user_id',
        'expense_sub_id',
        'amount',
        'title',
        'transaction_check',
        'transaction_note',
        'original_status',
        'status',
        'date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

}
