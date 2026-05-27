<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class EnrollmentController extends Controller
{
    public function check(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string',
            'username'  => 'required|string',
            'quizcode'  => 'required|string',
        ]);

        $student = Student::create($data);

        return response()->json(['status' => 'success', 'student' => $student]);
    }

    public function feedback(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'username' => 'required|string',
            'feedback' => 'required|string',
        ]);

        $student = Student::create($data);

        return response()->json(['status' => 'success', 'student' => $student]);
    }
}
