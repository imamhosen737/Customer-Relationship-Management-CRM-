<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
   //  protected $primaryKey = 'id';
    protected $fillable = ['customer_id','name', 'status', 'discription','start_date','end_date',];
     public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id',);
   }

   public function expense()
   {
      return $this->hasMany(Expense::class,'customer_id','id');
   }

   public function tasks(){
       
      return $this->hasMany(tasks::class);

 }

}

