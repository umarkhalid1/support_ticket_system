<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public const LOW_PRIORITY = 'low';
    public const MEDIUM_PRIORITY = 'medium';
    public const HIGH_PRIORITY = 'high';


    public const OPEN_STATUS = 'open';
    public const CLOSED_STATUS = 'closed';
    public const IN_PROGRESS_STATUS = 'in_progress';
    public const RESOLVED_STATUS = 'resolved';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignto()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
