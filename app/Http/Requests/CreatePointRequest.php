<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePointRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        'latitude' => 'required',
        'longitude' => 'required',
        'created_by' => 'required',
        'category' => 'required',
        ];
    }
}
