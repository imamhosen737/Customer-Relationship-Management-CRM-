<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'estimate_id',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'estimate_id', 'user_id');
    }
}
