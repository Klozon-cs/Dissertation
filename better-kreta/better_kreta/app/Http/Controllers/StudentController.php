<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Presence;
use App\Models\Schoolday;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('students.index', ['students' => $students, 'courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view("students.create", ['courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = new Student(
            [
                "name" => $request->name,
                "birthday" => $request->birthday,
                "course_id"=> $request->course_id
            ]
        );
        $student->save();


        $workdays = Schoolday::where('course_id', $student->course_id)->get();


        for ($i=0; $i < count($workdays); $i++) { 
            $presence = new Presence([
                'schoolday_id' => $workdays[$i]->id,
                'student_id' => $student->id,
                'state' => '1',

            ]);

            $presence->save();
        }


        return back()->with("success", $student->name." created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        $success = "Sikeres update";
        $pos = $request->autoSave;
        return redirect()->back()->with(compact("success", "pos"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Successfully deleted the student: ' . $student->name . '.');
    }


    public function show_deleted()
    {
        $courses = Course::all();
        $deleted_student = Student::onlyTrashed()->get();
        return view('students.show_deleted', ['students' => $deleted_student, 'courses' => $courses]);
    }

    public function restore(Student $student)
    {
        $student->restore();
        return back()->with('success', '' . $student->name . ' was successfully restored.');
    }
}
