<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Presence;
use App\Models\Schoolday;
use App\Http\Requests\StoreSchooldayRequest;
use App\Http\Requests\UpdateSchooldayRequest;
use App\Models\Student;

class SchoolDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Schoolday::all();
        $courses = Course::all();
        return view('school_days.index', ['days' => $days, 'courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view("school_days.create", ['courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchooldayRequest $request)
    {
        
        $day = new Schoolday(
            [
                "title" => $request->title,
                "date" => $request->date,
                "course_id"=> $request->course_id
            ]
        );
        $day->save();

        $students = Student::where('course_id', $day->course_id)->get();


        for ($i=0; $i < count($students); $i++) { 
            $presence = new Presence([
                'student_id' => $students[$i]->id,
                'schoolday_id' => $day->id,
                'state' => '1',
            ]);

            $presence->save();
        }




        return back()->with("success", $day->title." created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Schoolday $Schoolday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schoolday $Schoolday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchooldayRequest $request, Schoolday $Schoolday)
    {
        $Schoolday->update($request->all());

        $success = "Sikeres update";

        return redirect()->back()->with(compact("success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schoolday $Schoolday)
    {
        $Schoolday->delete();
        return back()->with('success', 'Successfully deleted the student: ' . $Schoolday->title . '.');
    }

    public function show_deleted()
    {
        $courses = Course::all();
        $deleted_student = Schoolday::onlyTrashed()->get();
        return view('school_days.show_deleted', ['schooldays' => $deleted_student, 'courses' => $courses]);
    }

    public function restore(Schoolday $schoolday)
    {
        $schoolday->restore();
        return back()->with('success', '' . $schoolday->date . ' was successfully restored.');
    }
}
