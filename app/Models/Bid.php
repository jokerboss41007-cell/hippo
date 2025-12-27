<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Bid extends Model
{
    use LogsActivity;

    protected $fillable = [
        'title',
        'bidding_profile_id',
        'assigned_to',
        'bid_amount',
        'status',
        'deadline',
        'proposal_url',
        'notes',
        'connections_used',
        'connections_left',
        'project_link',
        'technology',
        'outbid_count',
        'project_budget',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->useLogName('Bid')
            ->logOnlyDirty();
    }

    // Relationship to User assigned
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function biddingProfile()
    {
        return $this->belongsTo(BiddingProfile::class, 'bidding_profile_id');
    }

}
