<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
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
            'supplier_id' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric|not_in:0',
            'iva' => 'required|numeric',
            'discount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Seleccione el proveedor de la compra',
            'total.not_in' => 'Ingrese al menos un producto a sus compra',
        ];
    }
}
