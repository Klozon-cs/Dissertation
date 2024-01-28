<?php

namespace App\Observers;

use App\Models\Schoolday;
use Illuminate\Support\Facades\Auth;

class SchooldayObserver
{
    /**
     * Handle the Schoolday "created" event.
     */
    public function creating(Schoolday $schoolday): void
    {
        $user = Auth::user();
        $schoolday->created_by = $user ? $user->id :1;
        
    }
    
    /**
     * Handle the Schoolday "updated" event.
     */
    public function updating(Schoolday $schoolday): void
    {
        $user = Auth::user();
        $schoolday->updated_by = $user ? $user->id :1;
    }

    /**
     * Handle the Schoolday "deleted" event.
     */
    public function deleted(Schoolday $schoolday): void
    {
        //
    }

    /**
     * Handle the Schoolday "restored" event.
     */
    public function restored(Schoolday $schoolday): void
    {
        //
    }

    /**
     * Handle the Schoolday "force deleted" event.
     */
    public function forceDeleted(Schoolday $schoolday): void
    {
        //
    }
}
