<?php

namespace App\Providers;

use App\Events\MealAddedEvent;
use App\Events\PromotionMadeEvent;
use App\Events\ReviewAddedEvent;
use App\Listeners\NotifyUsersForAddedReviewListener;
use App\Listeners\NotifyUsersForNewMealListener;
use App\Listeners\NotifyUsersForPromotionListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MealAddedEvent::class => [
            NotifyUsersForNewMealListener::class,
        ],
        PromotionMadeEvent::class => [
            NotifyUsersForPromotionListener::class,
        ],

        ReviewAddedEvent::class => [
            NotifyUsersForAddedReviewListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
