<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all feedbacks.
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
