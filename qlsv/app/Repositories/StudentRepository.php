<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface
{
    public function all()
    {
        return Student::all(); // uses global scope!
    }

    public function find($id)
    {
        return Student::findOrFail($id);
    }

    public function studentsByClass($classId)
    {
        return Student::where('class_id', $classId)->get();
    }

    public function registerSubject($studentId, $subjectId)
    {
        $student = $this->find($studentId);
        $student->subjects()->attach($subjectId, [
            'score' => null,
            'registered_at' => now()
        ]);
        return $student;
    }
}
