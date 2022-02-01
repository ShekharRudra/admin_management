<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Models\LearnLibrary;

class Learn extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'mst_learn';
    protected $fillable = [
        'learn_library_id',
        'plan_id',
        'title',
        'description',
        'sequence_no',
        'is_active'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function learn_library()
    {
        return $this->belongsTo(LearnLibrary::class);
    }
}
