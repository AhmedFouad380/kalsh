<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidationTrait
{
    protected function add_validate($request)
    {
        return Validator::make($request->all(), $this->add_rules(), $this->add_messages());
    }

    public function add_rules()
    {
        return $this->rules();
    }

    protected function rules()
    {
        return [];
    }

    public function add_messages()
    {
        return $this->messages();
    }

    protected function messages()
    {
        return [];
    }

    protected function edit_validate($request, $item)
    {
        return Validator::make($request->all(), $this->edit_rules(), $this->edit_messages());
    }

    public function edit_rules($item)
    {
        return $this->rules();
    }

    public function edit_messages($item)
    {
        return $this->messages();
    }
}
