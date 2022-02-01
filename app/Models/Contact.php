<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'name',
        'email',
        'phone',
        'address',
    ];
    public function customers()
    {
        return $this->belongsTo(customers::class,'customer_id', 'id');
    }
}