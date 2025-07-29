<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyAttachment extends Model
{
    protected $fillable = [
        'ticket_reply_id',
        'file_path',
    ];
}
