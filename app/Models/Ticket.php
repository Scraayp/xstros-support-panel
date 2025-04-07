<?php

// app/Models/Ticket.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Ticket extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'user_id', 'title', 'description', 'status', 'closed_at', 'closer_id', 'assigned_to'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "Ticket has been $eventName")
        ->logOnly(['title', 'description', 'status', 'closed_at', 'assigned_to'])
        ->logOnlyDirty();
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function closer()
    {
        return $this->belongsTo(User::class, 'closer_id');
    }
}
