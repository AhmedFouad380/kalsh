<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ResearchProvidersTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarTypeResource;
use App\Http\Resources\PaymentCardResource;
use App\Http\Resources\ProviderResource;
use App\Models\CarType;
use App\Models\CarTypePrice;
use App\Models\PaymentCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LimousineServiceOrderController extends Controller
{
    use ResearchProvidersTrait;

    public function getCarTypes($distance)
    {
        $validator = Validator::make(['distance' => $distance], [
            'distance' => 'required|integer',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $car_types = CarType::Active()->get();
        foreach ($car_types as $key => $car_type) {
            $total = $car_type->start_price;
            $row = CarTypePrice::where('car_type_id', $car_type->id)
                ->where('from', '<=', $distance)
                ->where('to', '>=', $distance)
                ->first();
            if ($row) {
                $total += $row->price_per_km * $distance;
            }
            $car_type['total'] = $total;

        }
        $data = CarTypeResource::collection($car_types);
        return callback_data(success(), 'success_response', $data);
    }

    public function getNearestProviders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'car_type_id' => 'required|exists:car_types,id',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        // get providers in radius
        $providers = $this->nearestProviders($request->lat, $request->lng, nearest_radius(), null, "limousine");
        return callback_data(success(), 'nearest_providers', ProviderResource::collection($providers));
    }

    public function storePaymentCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placeholder_name' => 'required',
            'card_number' => 'required|unique:payment_cards',
            'expired_month' => 'required|digits:2|date_format:m',
            'expired_year' => 'required|digits:2|date_format:y|gte:'.date('y'),
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        PaymentCard::create([
            'user_id' => Auth::guard('user')->id(),
            'placeholder_name' => $request->placeholder_name,
            'card_number' => $request->card_number,
            'expired_month' => $request->expired_month,
            'expired_year' => $request->expired_year,
        ]);
        return callback_data(success(), 'save_success');
    }

    public function getPaymentCards()
    {
        $cards = PaymentCard::where('user_id', Auth::guard('user')->id())->active()->get();
        return callback_data(success(), 'payment_cards',PaymentCardResource::collection($cards));
    }



}
