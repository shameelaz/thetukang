<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravolt\Listeners\SendEmailVerificationNotification;
use App\Listeners\PayerListener;
use App\Events\InboxNote;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<string, array<string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        InboxNote::class => [
            PayerListener::class

        ],
    ];

    /**
     * @var array<string>
     */
    protected $subscribe = [
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
