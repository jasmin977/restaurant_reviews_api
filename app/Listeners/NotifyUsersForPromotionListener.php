<?php

namespace App\Listeners;

use App\Events\PromotionMadeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersForPromotionListener
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
     * @param  \App\Events\PromotionMadeEvent  $event
     * @return void
     */
    public function handle(PromotionMadeEvent $event)
    {
        //
    }
}
