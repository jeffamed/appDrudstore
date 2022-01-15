<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ReimbursementDetails;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Observers\OrderDetailsObserver;
use App\Observers\OrderObserve;
use App\Observers\ReimbursementDetailsObserver;
use App\Observers\SaleDetailsObserver;
use App\Observers\SaleObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        OrderDetails::observe(OrderDetailsObserver::class);
        Order::observe(OrderObserve::class);
        SaleDetails::observe(SaleDetailsObserver::class);
        Sale::observe(SaleObserver::class);
        ReimbursementDetails::observe(ReimbursementDetailsObserver::class);
    }
}
