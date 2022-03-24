<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReimbursementRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()){
            case 'POST':
                return true;
            case 'PUT':
            case 'PATCH':
                return true;
            default:
                return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'supplier_id' => 'required|integer',
            'order_id' => 'required|integer',
            'total' => 'required|numeric|not_in:0',
            'observation' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'total.not_in' => 'Seleccione una compra y elija un producto a devolver',
        ];
    }
}
