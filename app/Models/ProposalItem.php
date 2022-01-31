<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalItem extends Model
{
    use HasFactory;
    protected $table = 'proposalItems';
    protected $fillable = ['proposal_id', 'item_id', 'price', 'qty'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
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
