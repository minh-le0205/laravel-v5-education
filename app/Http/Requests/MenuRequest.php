<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    protected $table = 'menu';
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
        $condTypeMenu = implode(',', array_keys(config('zvn.template.type_menu')));

        $condTypeLink = implode(',', array_keys(config('zvn.template.type_link')));

        if (!empty($id)) { // edit
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
            'ordering'    => 'required',
            'link'        => 'bail|required',
            'type_menu'      => "bail|in:$condTypeMenu",
            'type_link'      => "bail|in:$condTypeLink",
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
