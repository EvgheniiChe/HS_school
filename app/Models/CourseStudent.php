<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;

    protected $table = 'course_student';

    protected $fillable = ['course_id', 'student_id'];

//    public function scopeWhereCourseIs(Builder $builder, Course $course): Builder
//    {
//        return $builder->where('course_id', $course->id);
//    }
}
