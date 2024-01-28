<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function creating(Student $student): void
    {
        $user= Auth::user();
        $student->created_by = $user ? $user->id :1;

    }

    /**
     * Handle the Student "updated" event.
     */
    public function updating(Student $student): void
    {
        $user= Auth::user();
        $student->updated_by = $user ? $user->id :1;
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
