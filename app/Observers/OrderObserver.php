<?php

namespace App\Observers;

use App\Helpers\ResearchProvidersTrait;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Status;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    use ResearchProvidersTrait;
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        if ($order->service_id == 4){ // ready service
            //send to nearest providers
            $this->readyServiceProviders($order);
        }
        if ($order->service_id == 5){ // dreams interpretation
            //send to chosen provider
            $this->dreamServiceProvider($order);
        }
        if ($order->service_id == 3){ // car service
            //send to chosen provider
            $this->CarServiceProviders($order);
        }
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
