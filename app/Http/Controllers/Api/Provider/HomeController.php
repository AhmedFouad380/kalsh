<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesResource;
use App\Http\Resources\ProviderFormResource;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ReadyServiceResource;
use App\Http\Resources\ServiceFormResource;
use App\Http\Resources\ServiceResource;
use App\Models\City;
use App\Models\Provider;
use App\Models\ProviderForm;
use App\Models\ProviderReadyService;
use App\Models\ProviderService;
use App\Models\ReadyService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    public function updateLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => error(), 'msg' => $validator->errors()->first()]);
        }

        $provider = Auth::guard('provider')->user();
        $provider->lat = $request->lat;
        $provider->lng = $request->lng;
        $provider->save();
        return callback_data(success(), 'save_success', ProviderResource::make($provider));
    }

    public function updateLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lang' => 'required|in:ar,en',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }
        $provider = Auth::guard('provider')->user();
        $provider->lang = $request->lang;
        $provider->save();
        return callback_data(success(), 'save_success', ProviderResource::make($provider));
    }

    public function services(Request $request)
    {
        $data = ServiceFormResource::collection(Service::where('is_provider', '!=', 0)->active()->orderBy('sort')->get());
        return callback_data(success(), 'success_response', $data);
    }

    public function cities()
    {
        $readyServices = CitiesResource::collection(City::where('status', 'active')->get());
        return callback_data(success(), 'success_response', $readyServices);
    }

    public function readyService()
    {
        $readyServices = ReadyServiceResource::collection(ReadyService::active()->orderBy('sort')->get());
        return callback_data(success(), 'readyServices', $readyServices);
    }

    public function storeForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image',
            'name' => 'required',
            'email' => 'required|email',
            'city_id' => 'required|exists:cities,id',
            'service_id' => [
                'required',
                'exists:services,id',
                Rule::unique('provider_services')->where(function ($query) {
                    $query->where('provider_id', Auth::guard('provider')->id());
                }), //assuming the request has platform information
            ],
            'ready_service_id' => 'required_if:service_id,4|array',
            'ready_service_id.*' => 'required_if:service_id,4|exists:ready_services,id',
            'id_image' => 'required_if:service_id,1,2',
            'driving_license_image' => 'required_if:service_id,1,2',
            'undermining_image' => 'required_if:service_id,1,2',
            'insurance_image' => 'required_if:service_id,1'
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => error(), 'msg' => $validator->errors()->first()]);
        }
        // store provider service
        $service = new ProviderService();
        $service->provider_id = Auth::guard('provider')->id();
        $service->service_id = $request->service_id;
        $service->save();

        // store ready provider service
        if (isset($request->ready_service_id)) {
            foreach ($request->ready_service_id as $readyService) {
                $ready_serivce = new ProviderReadyService();
                $ready_serivce->ready_service_id = $readyService;
                $ready_serivce->provider_id = Auth::guard('provider')->id();
                $ready_serivce->save();
            }
        }

        // store form
        $data = new ProviderForm();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->city_id = $request->city_id;
        $data->image = $request->image;
        $data->id_image = $request->id_image;
        $data->driving_license_image = $request->driving_license_image;
        $data->undermining_image = $request->undermining_image;
        $data->insurance_image = $request->insurance_image;
        $data->provider_id = Auth::guard('provider')->id();
        $data->service_id = $request->service_id;
        $data->save();
        return callback_data(success(), 'save_success');
    }

    public function registered_service(Request $request)
    {
        $exist_form = ProviderForm::where('provider_id', auth('provider')->user()->id)->where('service_id', $request->service_id)->first();
        if ($exist_form) {
            $data = (new ProviderFormResource($exist_form));
            return callback_data(success(), 'success_response', $data);
        } else {
            return callback_data(error(), 'no_form_found');
        }
    }
}
