<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $table = 'estimates';
    protected $fillable = [
        'customer_id',
        'subject',
        'date',
        'due_date',
        'status',
        'sign'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function estimateitems()
    {
        return $this->hasMany(EstimateItems::class);
    }
}
