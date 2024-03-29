<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'theme', 'start_time', 'info'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function homework()
    {
        return $this->hasOne(Homework::class);
    }
}
