<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheets extends Model
{
    use HasFactory;
     protected $table = 'timesheets';
     protected $primaryKey = 'id';
    protected $fillable = ['task_id','start_time','end_time','note'];
  

   public function task()
    {
        return $this->belongsTo(Tasks::class,'task_id','id');
}

}