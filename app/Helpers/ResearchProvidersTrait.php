<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;

trait ResearchProvidersTrait
{
    public function readyServiceProviders($order)
    {
        // get providers in order radius
        $providers = $this->nearestProviders($order->from_lat,$order->from_lng,$order->radius,$order);

        if (!$providers->isEmpty()){
            foreach ($providers as $provider){
                $this->sendProviderNotification($order,$provider);
            }
        }
    }

    public function CarServiceProviders($order)
    {
        // get providers in order radius
        $providers = $this->nearestProviders($order->from_lat,$order->from_lng,$order->radius,$order);

        if (!$providers->isEmpty()){
            foreach ($providers as $provider){
                $this->sendProviderNotification($order,$provider);
            }
        }
    }
    public function DeliveryServiceProviders($order)
    {
        // get providers in order radius
        $providers = $this->nearestProviders($order->from_lat,$order->from_lng,$order->range_provider,$order);

        if (!$providers->isEmpty()){
            foreach ($providers as $provider){
                $this->sendProviderNotification($order,$provider);
            }
        }
    }

    public function dreamServiceProvider($order)
    {
        if ($order->provider){
            $this->sendProviderNotification($order,$order->provider);
        }
    }

    public function nearestProviders($lat, $lng, $radius, $order=null)
    {
        $providers = Provider::active()
            ->online()
            ->select('providers.*',DB::raw('
                              6371 * ACOS(
                                  LEAST(
                                    1.0,
                                    COS(RADIANS(lat))
                                    * COS(RADIANS(' . $lat . '))
                                    * COS(RADIANS(lng - ' . $lng . '))
                                    + SIN(RADIANS(lat))
                                    * SIN(RADIANS(' . $lat . '))
                                  )
                                ) as distance'))
            ->having("distance", "<", $radius)
            ->when($order,function ($query) use ($order){
                $query->whereHas('providerServices',function ($query2) use ($order){
                    $query2->where('service_id',$order->service_id);
                })
                    ->when(!empty($order->ready_service_id),function ($query2) use ($order){
                        $query2->whereHas('providerReadyServices',function ($query3) use ($order){
                            $query3->where('ready_service_id',$order->ready_service_id);
                        });
                    });
            })

            ->orderBy("distance",'asc')
            ->get();
        return $providers;
    }

    public function sendProviderNotification($order,$provider)
    {
        $title_ar = '?????? ????????';
        $title_en = 'New Order';
        $msg_ar = '???????? ?????? ???????? ???????????? ??????.';
        $msg_en = 'You have a new order near you.';
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
