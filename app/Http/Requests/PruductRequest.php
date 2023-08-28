<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PruductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [


            'Product_name' => 'required|unique:products,Product_name,' . $this->pro_id,
            'section_id' => 'required',
        ];
    }
    public function messages()
    {
        return [

            'Product_name.required' => 'برجاي ادخال اسم المنتج',
            'Product_name.unique' => 'برجاي عدم تكرار اسم المنتج ',
            'section_id.required' => "برجاء ادخال اسم القسم",
        ];
    }
}
