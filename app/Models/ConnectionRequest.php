<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectionRequest extends Model
{
    protected $fillable = [
        'requested_by',
        'bidding_profile_id',
        'bidding_platform_id',
        'status',
        'notes',
    ];

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function biddingProfile()
    {
        return $this->belongsTo(BiddingProfile::class, 'bidding_profile_id');
    }

    public function biddingPlatform()
    {
        return $this->belongsTo(BiddingPlatform::class);
    }

}
