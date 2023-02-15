<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $viewPath = 'Admin.User.';
    private $route = 'users';

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        return view('Admin.User.index');
    }

    public function datatable(Request $request)
    {
        $data = User::orderBy('id', 'desc');

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
            ->AddColumn('is_active', function ($row) {
                $is_active = '<div class="badge badge-light-success fw-bolder">' . trans('lang.active') . '</div>';
                $not_active = '<div class="badge badge-light-danger fw-bolder">' . trans('lang.inactive') . '</div>';
                if ($row->status == 'active') {
                    return $is_active;
                } else {
                    return $not_active;
                }
            })
            ->addColumn('show', function ($row) {
                $actions = ' <a href="' . url("User-edit/show/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.view') . ' <i class="bi bi-eye-fill"></i>  </a>';
                return $actions;

            })
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . url("User-edit/" . $row->id) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;

            })
            ->rawColumns(['actions', 'checkbox', 'name', 'is_active', 'branch', 'show'])
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
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:admins|min:8',
            'is_active' => 'nullable|string',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->save();
        return redirect()->back()->with('message', 'تم الاضافة بنجاح ');
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
        $data = Order::where('user_id', $id)->orderBy('created_at', 'desc');

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
            ->addColumn('provider_name', function ($row) {
                return $row->provider ? ($row->provider->name ? $row->provider->phone : '') : '' ;
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
            ->rawColumns(['actions', 'checkbox', 'service', 'readyService', 'provider_name', 'status', 'payment_status'])
            ->make();

    }


    public function ratesDatatable(Request $request, $id)
    {
        $data = Rate::where('user_id', $id)->where('type', 'from_provider')->orderBy('created_at', 'desc');
        return DataTables::of($data)
            ->addColumn('provider_name', function ($row) {
                return $row->provider ? $row->provider->name  : '' ;
            })
            ->editColumn('created_at', function ($row) {
                $content = $row->created_at ? $row->created_at->format('Y-m-d g:i a') : '';
                return '<div class="badge badge-light-success">' . $content . '</div>';
            })
            ->addColumn('rate', 'Admin.providers.parts.rate_stars')
            ->rawColumns(['provider_name', 'created_at', 'rate'])
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
        $employee = User::findOrFail($id);
        return view('admin.User.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'id' => 'required|exists:users,id',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'nullable|confirmed',
            'phone' => 'required|min:8|unique:users,phone,' . $request->id,
            'is_active' => 'nullable|string',

        ]);


        $user = User::whereId($request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->status) {
            $user->status = $request->status;
        }
        if (isset($user->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();


        return redirect(url('User_setting'))->with('message', 'تم التعديل بنجاح ');
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
            User::whereIn('id', $request->id)->delete();
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
