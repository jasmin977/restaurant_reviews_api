<?php

namespace App\Listeners;

use App\Events\MealAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersForNewMealListener
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
     * @param  \App\Events\MealAddedEvent  $event
     * @return void
     */
    public function handle(MealAddedEvent $event)
    {
        //
    }
}
