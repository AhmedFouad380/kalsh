<?php

namespace App\Http\Controllers\Admin\Ready;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Ready\ReadyOrderRequest;
use App\Http\Requests\Dashboard\Ready\ReadyServiceRequest;
use App\Http\Requests\Dashboard\ServiceRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Models\ReadyService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ReadyOrdersController extends Controller
{
    protected $viewPath = 'Admin._Ready.ready_orders.';
    private $route = 'ready_orders';


    public function __construct(Order $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        return view($this->viewPath . '.index');
    }

    public function datatable(Request $request)
    {
        $data = $this->objectName::where('type', 'ready')->orderBy('created_at', 'desc');

        return DataTables::of($data)
            ->addColumn('checkbox', function ($row) {
                $checkbox = '';
                $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input selector" type="checkbox" value="' . $row->id . '" />
                                </div>';
                return $checkbox;
            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . route($this->route . ".show", ['id' => $row->id]) . '" class="btn btn-active-light-info">' . trans('lang.view') . ' <i class="bi bi-eye"></i>  </a>';
                return $actions;
            })
            ->addColumn('readyService', function ($row) {
                return $row->readyService ? $row->readyService->name : '';
            })
            ->addColumn('customer_name', function ($row) {
                return $row->user ? ($row->user->name? $row->user->phone : '') : '';
            })
            ->addColumn('provider_name', function ($row) {
                return $row->provider ? $row->provider->name : '';
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
            ->rawColumns(['actions', 'checkbox', 'readyService', 'customer_name', 'provider_name', 'status','payment_status'])
            ->make();

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

    public function store(ReadyOrderRequest $request)
    {
        $data = $request->validated();
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
        $data = $this->objectName::with(['userRating','providerRating'])->findOrFail($id);
        return view($this->viewPath . '.show', compact('data'));
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
    public function update(ReadyOrderRequest $request)
    {
        $data = $request->validated();
        if ($data['image'] == null) {
            unset($data['image']);
        } else {
            $img_name = 'service_' . time() . random_int(0000, 9999) . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('/uploads/services/'), $img_name);
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

    public function changeIsChecked(Request $request)
    {
        $data['is_checked'] = $request->is_checked;
        $this->objectName::where('id', $request->id)->update($data);
        return 1;
    }

    public function table_buttons()
    {
        return view($this->viewPath . '.button');
    }
}
