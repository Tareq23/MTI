<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegister;
use App\Listeners\UserRegisterListener;
use App\Events\ProjectModifiedEvent;
use App\Events\ProjectCreateEvent;
use App\Events\PostModifiedEvent;
use App\Events\PostCreateEvent;
use App\Listeners\PostCreateListener;
use App\Listeners\PostModifiedListener;
use App\Listeners\ProjectCreateListener;
use App\Listeners\ProjectModifiedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegister::class=>[
            UserRegisterListener::class,
        ],
        PostCreateEvent::class => [
            PostCreateListener::class,
        ],
        PostModifiedEvent::class => [
            PostModifiedListener::class,
        ],
        ProjectCreateEvent::class => [
            ProjectCreateListener::class,
        ],
        ProjectModifiedEvent::class => [
            ProjectModifiedListener::class,
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
