<?php

namespace App\Listeners;

use App\Events\OwnerWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PingOwnerWasCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OwnerWasCreated  $event
     * @return void
     */
    public function handle(OwnerWasCreated $event)
    {
        $owner = $event->owner;
        \Log::info("Owner Was Created: $owner->unit $owner->name");
    }
}
