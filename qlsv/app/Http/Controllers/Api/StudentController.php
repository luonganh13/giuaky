<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    protected $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function index()
    {
        return response()->json($this->studentRepo->all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class_id' => 'required|exists:classrooms,id',
            'is_active' => 'boolean'
        ]);

        $student = Student::create($validated);
        return response()->json($student, 201);
    }

    public function getSubjects($id)
    {
        $student = $this->studentRepo->find($id);
        return response()->json($student->subjects);
    }

    public function registerSubject(Request $request, $id, $subject_id)
    {
        $student = $this->studentRepo->registerSubject($id, $subject_id);
        return response()->json([
            'message' => 'Subject registered successfully', 
            'student' => $student->load('subjects')
        ]);
    }
}
