<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'user_id', 'assigned_to', 'company_name', 'photo', 'phone', 'address', 'vat_number', 'city', 'zip', 'country',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function proposal()
    {
        return $this->hasMany(Proposal::class);
    }

    public function estimate()
    {
        return $this->hasMany(Estimate::class);
    }
    public function project()
    {
        return $this->hasMany(Expense::class);
    }

    // public function assignedTo()
    // {
    //     return $this->belongsTo('App\Models\User', 'assigned_to', 'id');
    // }
}
