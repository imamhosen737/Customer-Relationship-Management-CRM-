<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'customer_id', 'item_id', 'invoice_number', 'invoice_type', 'interval', 'price', 'qty', 'tax', 'total', 'discount', 'payable', 'date', 'due_date', 'status'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customers');
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }
    public function items()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}
