<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'client_id',
        'bid_id',
        'project_manager',
        'project_link',
        'deadline',
        'completed_at',
        'technology',
        'project_budget',
        'final_cost',
        'profit',
        'loss',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
    public function manager()
    {
        return $this->belongsTo(User::class);
    }
}
