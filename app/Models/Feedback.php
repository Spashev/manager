<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'message',
        'image',
        'file',
        'user_id',
        'status_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get status.
     */
    public function status()
    {
        return $this->belongsTo(FeedbackStatus::class);
    }
}
