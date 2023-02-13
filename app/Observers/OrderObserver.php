<?php

namespace App\Observers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        // get providers in order radius
        $providers = Provider::active()
            ->online()
            ->select('providers.*',DB::raw('
                              6371 * ACOS(
                                  LEAST(
                                    1.0,
                                    COS(RADIANS(lat))
                                    * COS(RADIANS(' . $order->from_lat . '))
                                    * COS(RADIANS(lng - ' . $order->from_lng . '))
                                    + SIN(RADIANS(lat))
                                    * SIN(RADIANS(' . $order->from_lat . '))
                                  )
                                ) as distance'))
            ->having("distance", "<", $order->radius)
            ->orderBy("distance",'asc')
            ->get();

        if (!$providers->isEmpty()){
            foreach ($providers as $provider){
                Offer::create([
                    'order_id' => $order->id,
                    'provider_id' => $provider->id,
                    'status_id' => Status::PENDING_STATUS,
                ]);
                $provider = Provider::findOrFail($provider->id);
                sendToProvider([$provider->device_token],'','');
            }
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
