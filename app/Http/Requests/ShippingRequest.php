<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{
    protected $table = 'rss';
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
        $id = $this->id;

        $condName  = "bail|required|between:5,100|unique:$this->table,name";
        $condCost = "bail|numeric|min:1";

        if (!empty($id)) {
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
            'status'      => 'bail|in:active,inactive',
            'cost'        => $condCost
        ];
    }

    public function messages()
    {
        return [];
    }
    public function attributes()
    {
        return [];
    }
}