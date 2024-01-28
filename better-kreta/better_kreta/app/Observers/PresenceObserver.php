<?php

namespace App\Observers;

use App\Models\Presence;
use Illuminate\Support\Facades\Auth;

class PresenceObserver
{
    /**
     * Handle the Presence "created" event.
     */
    public function creating(Presence $presence): void
    {
        $user = Auth::user();
        $presence->created_by = $user ? $user->id :1;
    }

    /**
     * Handle the Presence "updated" event.
     */
    public function updating(Presence $presence): void
    {
        $user = Auth::user();
        $presence->updated_by = $user ? $user->id :1;
    }

    /**
     * Handle the Presence "deleted" event.
     */
    public function deleted(Presence $presence): void
    {
        //
    }

    /**
     * Handle the Presence "restored" event.
     */
    public function restored(Presence $presence): void
    {
        //
    }

    /**
     * Handle the Presence "force deleted" event.
     */
    public function forceDeleted(Presence $presence): void
    {
        //
    }
}
