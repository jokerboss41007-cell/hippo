<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiddingProfile extends Model
{
    protected $fillable = [
        'bidding_platform_id',
        'created_by',
        'profile_name',
        'profile_url',
        'email',
        'username',
        'password_note',
        'category',
        'skills',
        'success_score',
        'rating',
        'connects_or_tokens',
        'notes',
        'status',
    ];

    public function biddingPlatform()
    {
        return $this->belongsTo(BiddingPlatform::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function connectionRequests()
    {
        return $this->hasMany(ConnectionRequest::class, 'bidding_profile_id');
    }


}
