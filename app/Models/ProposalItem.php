<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalItem extends Model
{
    use HasFactory;
    protected $table = 'proposalItems';
    protected $fillable = ['proposal_id', 'item_id'];

    public function proposal()
    {
        return $this->hasOne('App\Models\Proposal', 'id', 'proposal_id');
    }

    public function item()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }

    public function scopeLoadRelation($query)
    {
        return $query->with([
            'proposal',
            'proposal.customer',
            'proposal.customer.user',
            'proposal.customer.assignedTo',
            'item',
            'item.unit',
        ]);
    }
}
