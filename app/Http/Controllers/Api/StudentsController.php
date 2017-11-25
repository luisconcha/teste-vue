<?php

namespace LACC\Http\Controllers\Api;

use Illuminate\Http\Request;
use LACC\Http\Controllers\Controller;
use LACC\Models\Student;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        return !$search ?
            [] :
            Student::whereHas('user', function ($query) use ($search) {
                $query->where('users.name', 'LIKE', "%{$search}%");
            })
                ->take(10)
                ->get();
    }
}
