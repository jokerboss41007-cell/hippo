<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiddingPlatform extends Model
{
    protected $fillable = [
        'title',
        'current_connection_balance',
        'status',
        'per_connection_cost',
        'minimum_threshold_connection',
        'conversion_rate',
    ];

    public function connectionRequests()
    {
        return $this->hasMany(ConnectionRequest::class, 'bidding_platform_id');
    }

    public function biddingProfiles()
    {
        return $this->hasMany(BiddingProfile::class, 'bidding_platform_id');
    }

    public function pendingConnectionRequests()
    {
        return $this->connectionRequests()->where('status', 'pending');
    }


    // public function connectionRequests()
    // {
    //     return $this->hasMany(ConnectionRequest::class, 'bidding_platform_id')
    //                 ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
    //                 ->orderBy('created_at', 'desc');
    // }

}
