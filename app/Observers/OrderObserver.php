<?php

namespace App\Observers;

use App\Models\Notification;
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
            ->whereHas('providerServices',function ($query) use ($order){
                $query->where('service_id',$order->service_id);
            })
            ->when(!empty($order->ready_service_id),function ($query) use ($order){
                $query->whereHas('providerReadyServices',function ($query2) use ($order){
                    $query2->where('ready_service_id',$order->ready_service_id);
                });
            })
            ->orderBy("distance",'asc')
            ->get();

        if (!$providers->isEmpty()){
            foreach ($providers as $provider){
                $title_ar = 'طلب جديد';
                $title_en = 'New Order';
                $msg_ar = 'لديك طلب جديد بالقرب منك، سارع بتقديم عرضك.';
                $msg_en = 'You have a new order near you, hurry up and submit your offer.';
                sendToProvider([$provider->device_token],${'title_'.$provider->lang},${'msg_'.$provider->lang},Notification::NEW_ORDER_TYPE,$order->id,$order->type);

                Notification::create([
                    'type' => Notification::NEW_ORDER_TYPE,
                    'notifiable_type' => Provider::class,
                    'notifiable_id' => $provider->id,
                    'order_id' => $order->id,
                    'title_ar' => $title_ar,
                    'title_en' => $title_en,
                    'description_ar' => $msg_ar,
                    'description_en' => $msg_en,
                ]);
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
