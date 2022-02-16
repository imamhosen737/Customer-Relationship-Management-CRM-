<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Tasks extends Model
// {
//   use HasFactory;
//   protected $table = 'tasks';
//   protected $fillable = ['project_id',
//   'subject','status','description','start_date','end_date','priority','visible_to_customer'];
  

//    public function project()
//     {
//         return $this->belongsTo(Project::class,'project_id','id');
//    }
// }



class Tasks extends Model
{
  use HasFactory;
  protected $table = 'tasks';
  protected $fillable = [
    'project_id','milestone_id','user_id',
    'subject','duration', 'status', 'description', 'start_date', 'end_date', 'priority', 'visible_to_customer'
  ];


  public function project()
  {
    return $this->belongsTo(Project::class, 'project_id', 'id');
  }

  public function Milestones()
  {
    return $this->belongsTo(Milestones::class, 'milestone_id', 'id');
  }

  public function User()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}



