<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = 'proposals';
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

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\ProposalItem', 'proposal_id', 'id');
    }

    public function scopeLoadRelation($query)
    {
        return $query->with([
            'customers',
            'customers.user',
            // 'customer.assignedTo',
            'items',
            'items.item',
            'items.item.unit',
            'items.item.tax',
        ]);
    }
}
