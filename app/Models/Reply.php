<?php

// app/Models/Reply.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Reply extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'ticket_id', 'user_id', 'message', 'role'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "Ticket reply has been $eventName")
        ->logOnly(['title', 'description', 'status', 'closed_at', 'assigned_to'])
        ->logOnlyDirty();
    }
}

