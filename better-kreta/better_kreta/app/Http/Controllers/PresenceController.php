<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Presence;
use App\Http\Requests\StorePresenceRequest;
use App\Http\Requests\UpdatePresenceRequest;
use App\Models\Schoolday;
use App\Models\Student;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $std = Student::all();
        $days = Schoolday::all();
        $courses = Course::all();
        $pr = Presence::all();
        return view('presences.index', ["presences" => $pr, 'courses' => $courses, 'students' => $std, 'days' => $days]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresenceRequest $request, Presence $presence)
    {
        $presence->update($request->all());

        $success = "Sikeres update";
        $pos = $request->autoSave;
        return redirect()->back()->with(compact("success", "pos"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
