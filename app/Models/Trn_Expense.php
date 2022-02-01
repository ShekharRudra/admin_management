<?php

namespace App\Models;
use App\Models\Learn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Trn_Expense extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'trn_expense';
    protected $fillable = [
        'user_id',
        'type',
        'expense_name',
        'sequence_no',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

}
