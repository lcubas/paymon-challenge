<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Communication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'message',
        'send_date',
        'course_id',
        'min_age',
        'max_age',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'send_date' => 'datetime',
        'min_age' => 'integer',
        'max_age' => 'integer',
    ];

    /**
     * Get the course that owns the communication.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
