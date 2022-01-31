<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
  use HasFactory;
  protected $table = 'tasks';
  protected $fillable = ['project_id',
  'subject','status','description','start_date','end_date','priority','visible_to_customer'];
  

   public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
   }
}




