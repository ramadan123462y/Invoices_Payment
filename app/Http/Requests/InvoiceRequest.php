<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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



            'invoice_number' => 'required|unique:invoices,invoice_number,' . $this->id,
            'invoice_Date' => 'required|date',
            'Due_date' => 'required|date|after:invoice_Date',
            'product' => 'required',
            'Section' => 'required',
            'Amount_collection' => 'required',
            'Amount_Commission' => 'required',
            'Discount' => 'required',
            'Value_VAT' => 'required',
            'Rate_VAT' => 'required',
            'Total' => 'required',



        ];
    }
    public function messages()
    {
        return [


            'invoice_number.required' => ' ادخال الحقل ',
            'invoice_number.unique' => ' الفاتوره موجود بالفعل',
            'invoice_Date.required' => ' ادخال الحقل ',
            'Due_date.after' => ' لازم التاريخ الاستحقاق بعد تاريخ الفاتورة',
            'product.required' => ' ادخال الحقل ',
            'Section.required' => 'section_idبرجاء ادخال الحقل ',
            'Amount_collection.required' => ' ادخال الحقل ',
            'Amount_Commission.required' => ' ادخال الحقل ',
            'Discount.required' => ' ادخال الحقل ',
            'Value_VAT.required' => ' ادخال الحقل ',
            'Rate_VAT.required' => ' ادخال الحقل ',
            'Total.required' => ' ادخال الحقل ',


        ];
    }
}
