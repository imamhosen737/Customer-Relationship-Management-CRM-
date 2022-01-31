<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalUser extends Model
{
    use HasFactory;
    protected $table='proposalusers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'proposal_id',
        'user_id',
        ];

         public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
