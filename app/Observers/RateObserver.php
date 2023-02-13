<?php

namespace App\Observers;

use App\Models\Provider;
use App\Models\Rate;
use App\Models\User;

class RateObserver
{
    /**
     * Handle the Rate "created" event.
     *
     * @param \App\Models\Rate $rate
     * @return void
     */
    public function created(Rate $rate)
    {
        // rate provider
        if ($rate->type == 'from_user') {
            $rates = Rate::where('provider_id', $rate->provider_id)->where('type', 'from_user');
            $sum = $rates->sum('rate');
            $count = $rates->count();
            $provider = Provider::where('id', $rate->provider_id)->first();
            if ($provider) {
                $provider->rate = $sum / $count;
                $provider->save();
            }
        }
        // rate user
        if ($rate->type == 'from_provider') {
            $rates = Rate::where('user_id', $rate->user_id)->where('type', 'from_provider');
            $sum = $rates->sum('rate');
            $count = $rates->count();
            $provider = User::where('id', $rate->user_id)->first();
            if ($provider) {
                $provider->rate = $sum / $count;
                $provider->save();
            }
        }
    }


    /**
     * Handle the Rate "updated" event.
     *
     * @param \App\Models\Rate $rate
     * @return void
     */
    public function updated(Rate $rate)
    {
        //
    }

    /**
     * Handle the Rate "deleted" event.
     *
     * @param \App\Models\Rate $rate
     * @return void
     */
    public function deleted(Rate $rate)
    {
        //
    }

    /**
     * Handle the Rate "restored" event.
     *
     * @param \App\Models\Rate $rate
     * @return void
     */
    public function restored(Rate $rate)
    {
        //
    }

    /**
     * Handle the Rate "force deleted" event.
     *
     * @param \App\Models\Rate $rate
     * @return void
     */
    public function forceDeleted(Rate $rate)
    {
        //
    }
}
