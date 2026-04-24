<?php

namespace App\Repositories;

interface StudentRepositoryInterface
{
    public function all();
    public function find($id);
    public function studentsByClass($classId);
    public function registerSubject($studentId, $subjectId);
}
