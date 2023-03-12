<?php

namespace App\Helpers;

use App\Models\CarType;
use App\Models\CarTypePrice;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;

trait ResearchProvidersTrait
{
    public function readyServiceProviders($order)
    {
        // get providers in order radius
        $providers = $this->nearestProviders($order->from_lat, $order->from_lng, $order->radius, $order);

        if (!$providers->isEmpty()) {
            foreach ($providers as $provider) {
                $this->sendProviderNotification($order, $provider);
            }
        }
    }

    public function CarServiceProviders($order)
    {
        // get providers in order radius
        $providers = $this->nearestProviders($order->from_lat, $order->from_lng, $order->radius, $order);

        if (!$providers->isEmpty()) {
            foreach ($providers as $provider) {
                $this->sendProviderNotification($order, $provider);
            }
        }
    }

    public function LimousineServiceProviders($order)
    {
        // get providers in order radius
        $providers = $this->nearestProviders($order->from_lat, $order->from_lng, $order->radius, $order);

        if (!$providers->isEmpty()) {
            foreach ($providers as $provider) {
                $this->sendProviderNotification($order, $provider);
            }
        }
    }

    public function dreamServiceProvider($order)
    {
        if ($order->provider) {
            $this->sendProviderNotification($order, $order->provider);
        }
    }

    public function nearestProviders($lat, $lng, $radius, $order = null, $service = null)
    {
        $providers = Provider::active()
            ->online()
            ->select('providers.*', DB::raw('
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
            ->when($order, function ($query) use ($order) {
                $query->whereHas('providerServices', function ($query2) use ($order) {
                    $query2->where('service_id', $order->service_id);
                })
                    ->when(!empty($order->ready_service_id), function ($query2) use ($order) {
                        $query2->whereHas('providerReadyServices', function ($query3) use ($order) {
                            $query3->where('ready_service_id', $order->ready_service_id);
                        });
                    });
            })->when($service && $service == "dream", function ($query4) {
                $query4->whereHas('providerServices', function ($query5) {
                    $query5->where('service_id', 5);
                });
            })
            ->when($service && $service == "limousine", function ($query4) {
                $query4->where('car_type_id', request()->car_type_id)
                    ->whereHas('providerServices', function ($query5) {
                        $query5->where('service_id', 2);
                    });
            })
            ->orderBy("distance", 'asc')
            ->get();
        return $providers;
    }

    public function sendProviderNotification($order, $provider)
    {
        $title_ar = 'طلب جديد';
        $title_en = 'New Order';
        $msg_ar = 'لديك طلب جديد بالقرب منك.';
        $msg_en = 'You have a new order near you.';
        sendToProvider([$provider->device_token], ${'title_' . $provider->lang}, ${'msg_' . $provider->lang}, Notification::NEW_ORDER_TYPE, $order->id, $order->type);

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

    public function carTypeTotalPrice($car_type_id ,$distance){
        $car_type = CarType::whereId($car_type_id)->first();
        $total = $car_type->start_price;
        $row = CarTypePrice::where('car_type_id', $car_type->id)
            ->where('from', '<=', $distance)
            ->where('to', '>=', $distance)
            ->first();
        if ($row) {
            $total += $row->price_per_km * $distance;
        }

        return $total;
    }

}
