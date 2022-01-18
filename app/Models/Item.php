<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'rate',
        'tax_id',
        'unit_id'
    ];

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function estimateitems()
    {
        return $this->hasMany(EstimateItems::class);
    }
}
