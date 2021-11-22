<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends BaseRequest
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
            'code' => 'required|unique|max:13',
            'name' => 'required|max:250',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|integer',
            'box_stock' => 'required|numeric',
            'expire_at' => 'required|date',
            'laboratory_id' => 'nullable|integer',
            'type_id' => 'nullable|integer',
            'location_id' => 'nullable|integer',
            'supplier_id' => 'nullable|integer',
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
            'code' => 'required|max:13',
            'name' => 'required|max:250',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'discount' => 'required|numeric',
            'stock' => 'required|integer',
            'box_stock' => 'required|numeric',
            'expire_at' => 'required|date',
            'laboratory_id' => 'nullable|integer',
            'type_id' => 'nullable|integer',
            'location_id' => 'nullable|integer',
            'supplier_id' => 'nullable|integer',
        ];
    }
}
