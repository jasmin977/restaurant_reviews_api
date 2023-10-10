<?php

namespace App\Listeners;

use App\Events\ReviewAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersForAddedReviewListener
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
     * @param  \App\Events\ReviewAddedEvent  $event
     * @return void
     */
    public function handle(ReviewAddedEvent $event)
    {
        //
    }
}
