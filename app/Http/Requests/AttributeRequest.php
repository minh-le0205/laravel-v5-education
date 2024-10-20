<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    protected $table = 'attribute';
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

        if (!empty($id)) { // edit
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
            'ordering'    => 'required',
            'status'      => 'bail|in:active,inactive',
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
