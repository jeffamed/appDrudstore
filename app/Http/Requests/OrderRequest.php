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
            'id_supplier' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric|not_in:0',
            'iva' => 'required|numeric',
            'discount' => 'required|numeric',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function update()
    {
        return [
            'id_supplier' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric|not_in:0',
            'iva' => 'required|numeric',
            'discount' => 'required|numeric',
        ];
    }
}
