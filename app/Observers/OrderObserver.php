<?php

namespace App\Observers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Status;
use Illuminate\Support\Facades\Config;
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
            $notificationType = Config::get('notificationtypes.new_order');
            foreach ($providers as $provider){
                $title = Config::get('response.new_ready_order_title.'.$provider->lang);
                $msg = Config::get('response.new_ready_order_msg.'.$provider->lang);
                sendToProvider([$provider->device_token],$title,$msg,$notificationType,$order->id,$order->type);
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
