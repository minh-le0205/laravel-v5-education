<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    protected $table = 'product';
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
        // $thumbCondition = 'bail|required|image|max:100';
        $nameCondition = "bail|required|between:5,100|unique:$this->table,name";
        if (!empty($id)) {
            // $thumbCondition = 'bail|image|max:100';
            $nameCondition .= ",$id";
        }
        return [
            'name' => $nameCondition,
            'content' => 'bail|required|min:5',
            'status' => 'bail|in:active,inactive',
            // 'thumb' => $thumbCondition
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'content.required' => 'Content is required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Field name',
        ];
    }
}
