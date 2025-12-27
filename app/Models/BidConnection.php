<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidConnection extends Model
{

    protected $table = 'bid_connection_requests';

    protected $fillable = [
        'bid_id',
        'requested_by',
        'connections_requested',
        'status',
        'admin_notes',
    ];


    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class,'requested_by');
    }
}
