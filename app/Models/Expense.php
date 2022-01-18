<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // protected $table = 'expenses';
    // protected $primaryKey = 'id';
    protected $fillable = ['name', 'note', 'expense_date','amount','project_id','expenseCategory_id'];

     public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function expenseCategory()
    {
        return $this->belongsTo(Expense_category::class,'expenseCategory_id','id');
    }
}
