<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformCredential extends Model
{
    protected $fillable = [
        'platform',
        'username',
        'email',
        'password',
        'special_question',
        'special_answer',
        'api_key',
        'profile_url',
    ];
}
