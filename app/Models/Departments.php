<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class Departments extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'name'
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
