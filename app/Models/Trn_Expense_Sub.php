<?php

namespace App\Models;
use App\Models\Learn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Trn_Expense_Sub extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'trn_expense_sub';
    protected $fillable = [
        'expense_id',
        'sub_expense_name',
        'planned_amount',
        'is_favorite',
        'note',
        'sequence_no',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

}
