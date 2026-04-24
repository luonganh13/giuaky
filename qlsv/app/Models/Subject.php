<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject_name'];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot(['score', 'registered_at']);
    }
}
