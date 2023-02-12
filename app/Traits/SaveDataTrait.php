<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait SaveDataTrait
{
    protected function prepare_data_to_add($data)
    {
        return $data;
    }

    protected function prepare_data_to_update($data)
    {
        return $data;
    }

    protected function get_data($form_type = 'add', Request $request)
    {
        return $request->all();
    }
}
