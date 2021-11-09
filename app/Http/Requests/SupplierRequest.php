<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'ruc' => 'required|max:13',
            'name' => 'required|max:250',
            'address' => 'nullable',
            'phone' => 'nullable|max:10'
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
            'ruc' => 'required|max:13',
            'name' => 'required|max:250',
            'address' => 'nullable',
            'phone' => 'nullable|max:10'
        ];
    }
}
