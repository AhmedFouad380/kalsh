<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Car\CarServiceRequest;
use App\Models\CarService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CarServicesController extends Controller
{
    protected $viewPath = 'Admin._Car.car_services.';
    private $route = 'car_services';


    public function __construct(CarService $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        return view($this->viewPath . '.index');
    }

    public function datatable(Request $request)
    {
        $data = $this->objectName::where('parent_id', null)->orderBy('sort', 'asc');
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
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . route($this->route . ".edit", ['id' => $row->id]) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;
            })
            ->addColumn('subService', function ($row) {
                $actions = ' <a href="' . route($this->route . ".show", ['id' => $row->id]) . '" class="btn btn-light-info">' . $row->children->count() . ' <i class="bi bi-eye-fill"></i>  </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'name', 'is_active', 'subService'])
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

    public function store(CarServiceRequest $request)
    {
        $data = $request->validated();
        $this->objectName::create($data);
        if (isset($data['parent_id'])) {
            return redirect(route($this->route . '.show', $data['parent_id']))->with('message', trans('lang.added_s'));

        } else {
            return redirect(route($this->route . '.index'))->with('message', trans('lang.added_s'));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view($this->viewPath . '.sub_services.index', compact('id'));
    }

    public function subServicesTableButtons($id)
    {
        return view($this->viewPath . '.sub_services.button', compact('id'));
    }

    public function subServicesDatatable(Request $request)
    {
        $data = $this->objectName::where('parent_id', $request->id)->orderBy('sort', 'asc');
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
            ->addColumn('actions', function ($row) {
                $actions = ' <a href="' . route($this->route . ".edit", ['id' => $row->id]) . '" class="btn btn-active-light-info">' . trans('lang.edit') . ' <i class="bi bi-pencil-fill"></i>  </a>';
                return $actions;
            })
            ->rawColumns(['actions', 'checkbox', 'name', 'is_active'])
            ->make();

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
    public function update(CarServiceRequest $request)
    {
        $data = $request->validated();
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
}
