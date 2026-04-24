<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_name', 'class_id', 'is_active'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot(['score', 'registered_at']);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected static function booted()
    {
        static::addGlobalScope('order_by_name', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy('student_name', 'asc');
        });
    }
}
