<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_category extends Model
{
    use HasFactory;
    protected $table="expense_categories";
    protected $fillable=['name'];

    public function expense()
    {
        return $this->hasMany(Expense::class,'expenseCategory_id','id');
    }
}
