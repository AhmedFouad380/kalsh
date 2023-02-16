<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\PagesRequest;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PagesController extends Controller
{
    protected $viewPath = 'Admin.pages.';
    private $route = 'pages';

    public function __construct(Page $model)
    {
        $this->objectName = $model;
    }

    public function edit($type)
    {
        $data = $this->objectName::where('type', $type)->first();
        return view($this->viewPath . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagesRequest $request)
    {
        $data = $request->validated();
        $this->objectName::whereType($request->type)->update($data);
        return redirect()->back()->with('message', trans('lang.updated_s'));
    }

}
