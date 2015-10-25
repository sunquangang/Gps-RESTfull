<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePointsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'latitude' => 'required|min:3',
            'longitude' => 'required|min:3',
            'tags' => 'required',
            'country' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ];
    }
}
