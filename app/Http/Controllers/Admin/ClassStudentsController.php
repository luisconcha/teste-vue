<?php

namespace LACC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LACC\Http\Controllers\Controller;
use LACC\Http\Requests\ClassStudentRequest;
use LACC\Models\ClassInformation;
use LACC\Models\Student;

class ClassStudentsController extends Controller
{
    /**
     * @param Request $request
     * @param ClassInformation $class_information
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Database\Eloquent\Collection|\Illuminate\View\View
     */
    public function index(Request $request, ClassInformation $class_information)
    {
        if (!$request->ajax()) {
            return view('admin.class_informations.class_student', compact('class_information'));
        } else {
            return $class_information->students()->get();
        }
    }


    /**
     * @param ClassStudentRequest $request
     * @param ClassInformation $class_information
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function store(ClassStudentRequest $request, ClassInformation $class_information)
    {
        $student = Student::find($request->get('student_id'));
        $class_information->students()->save($student);
        return $student;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
