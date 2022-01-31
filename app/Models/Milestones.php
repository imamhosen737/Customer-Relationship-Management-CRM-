<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestones extends Model
{
    use HasFactory;
    protected $table = "milestone";

    protected $fillable = [
        'project_id','name','end_date','description','ordering','visible_to_customer','status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
