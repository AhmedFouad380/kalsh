<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NewsRequest;
use App\Http\Requests\Dashboard\ProviderRequest;
use App\Http\Requests\Dashboard\ServiceRequest;
use App\Models\Admin;
use App\Models\News;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Rate;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ProvidersController extends Controller
{
    protected $viewPath = 'Admin.providers.';
    private $route = 'providers';

    public function __construct(Provider $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        return view($this->viewPath . '.index');
    }


    public function datatable(Request $request)
    {
        $data = $this->objectName::orderBy('id', 'desc');
        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input selector" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->editColumn('name', function ($row) {
                $name = '';
                $name .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</span>';
                return $name;
            })
            ->addColumn('is_active', $this->viewPath . 'parts.active_btn')
//            ->addColumn('actions', function ($row) {
//                $actions = ' <a href="' . url($this->route . "/edit/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
//                return $actions;
//
//            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url($this->route . "/show/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.view') . ' <i class="bi bi-eye-fill"></i>  </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'is_active', 'branch'])
            ->make();

    }

    public function table_buttons()
    {
        return view($this->viewPath . '.button');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProviderRequest $request)
    {
        $data = $request->validated();
        $data['email_verified_at'] = Carbon::now();
        $this->objectName::create($data);
        return redirect(route($this->route . '.index'))->with('message', trans('lang.added_s'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . '.show.show', compact('data'));
    }

    public function orders($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . '.show.show', compact('data'));
    }

    public function ordersDatatable(Request $request, $id)
    {
        $data = Order::where('provider_id', $id)->orderBy('created_at', 'desc');

        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input selector" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . route("ready_orders.show", ['id' => $row->id]) . '" class="btn btn-active-light-info">' . trans('lang.view') . ' <i class="bi bi-eye"></i>  </a>';
                return $actions;
            })
            ->addColumn('readyService', function ($row) {
                return $row->readyService ? $row->readyService->name : '';
            })
            ->addColumn('customer_name', function ($row) {
                return $row->user ? $row->user->name : '';
            })
            ->addColumn('provider_name', function ($row) {
                return $row->provider ? $row->provider->name : '';
            })
            ->addColumn('service', function ($row) {
                return $row->service ? $row->service->name : '';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d g:i a') : '';
            })
            ->addColumn('payment_status', function ($row) {
                $text = $row->payment_status ? trans('lang.' . $row->payment_status) : '';
                return ' <span class="text-gray-800 text-hover-primary mb-1">' . $text . '</span>';
            })
            ->addColumn('status', function ($row) {
                $text = $row->status ? trans('lang.' . $row->status->name) : '';
                return ' <span class="text-gray-800 text-hover-primary mb-1">' . $text . '</span>';
            })
            ->rawColumns(['actions', 'checkbox', 'service', 'readyService', 'customer_name', 'provider_name', 'status', 'payment_status'])
            ->make();

    }


    public function ratesDatatable(Request $request, $id)
    {
        $data = Rate::where('provider_id', $id)->where('type', 'from_user')->orderBy('created_at', 'desc');
        return DataTables::of($data)
            ->addColumn('customer_name', function ($row) {
                return $row->user ? ($row->user->name ? $row->user->phone : '') : '';
            })
            ->editColumn('created_at', function ($row) {
                $content = $row->created_at ? $row->created_at->format('Y-m-d g:i a') : '';
                return '<div class="badge badge-light-success">' . $content . '</div>';
            })
            ->addColumn('rate', $this->viewPath . 'parts.rate_stars')
            ->rawColumns(['customer_name', 'created_at', 'rate'])
            ->make();
    }


    public function rates($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . '.show.show', compact('data'));
    }

    public function offers($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . '.show.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request)
    {
        $data = $request->validated();
        if ($data['image'] == null) {
            unset($data['image']);
        } else {
            $img_name = 'provider_' . time() . random_int(0000, 9999) . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('/uploads/providers/'), $img_name);
            $data['image'] = $img_name;
        }
        $this->objectName::whereId($request->id)->update($data);
        return redirect(route($this->route . '.index'))->with('message', trans('lang.updated_s'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $this->objectName::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }

    public function changeActive(Request $request)
    {
        $data['status'] = $request->status;
        $this->objectName::where('id', $request->id)->update($data);
        return 1;
    }
}
