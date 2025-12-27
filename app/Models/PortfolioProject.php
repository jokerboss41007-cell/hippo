<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class PortfolioProject extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'title',
        'technology',
        'description',
        'project_url',
        'completed_on',
        'project_snap',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->useLogName('portfolio_project')
            ->logOnlyDirty();
    }
}
