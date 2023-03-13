<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Offer;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class OfferObserver
{
    /**
     * Handle the Offer "created" event.
     *
     * @param \App\Models\Offer $offer
     * @return void
     */
    public function created(Offer $offer)
    {
        if ($offer->status_id == Status::PENDING_STATUS) {
            $order = $offer->order;
            $user = User::where('id', $order->user_id)->first();

            $title_ar = 'عرض جديد';
            $title_en = 'New Offer';
            $msg_ar = 'قام ' . $offer->provider->name . ' بتقديم عرض جديد علي طلبك.';
            $msg_en = $offer->provider->name . ' Send you a new offer for your order.';

            sendToUser([$user->device_token], ${'title_' . $user->lang}, ${'msg_' . $user->lang}, Notification::NEW_OFFER_TYPE, $order->id, $order->type);

            Notification::create([
                'type' => Notification::NEW_OFFER_TYPE,
                'notifiable_type' => User::class,
                'notifiable_id' => $user->id,
                'order_id' => $order->id,
                'offer_id' => $offer->id,
                'title_ar' => $title_ar,
                'title_en' => $title_en,
                'description_ar' => $msg_ar,
                'description_en' => $msg_en,
            ]);
        }

    }

    /**
     * Handle the Offer "updated" event.
     *
     * @param \App\Models\Offer $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        //
    }

    /**
     * Handle the Offer "deleted" event.
     *
     * @param \App\Models\Offer $offer
     * @return void
     */
    public function deleted(Offer $offer)
    {
        //
    }

    /**
     * Handle the Offer "restored" event.
     *
     * @param \App\Models\Offer $offer
     * @return void
     */
    public function restored(Offer $offer)
    {
        //
    }

    /**
     * Handle the Offer "force deleted" event.
     *
     * @param \App\Models\Offer $offer
     * @return void
     */
    public function forceDeleted(Offer $offer)
    {
        //
    }
}
