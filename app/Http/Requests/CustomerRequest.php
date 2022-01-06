<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends BaseRequest
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
            'document' => 'required|max:13',
            'name' => 'required|max:250',
            'last_name' => 'nullable|max:250',
            'address' => 'nullable',
            'phone' => 'nullable|max:10',
            'email' => 'nullable|email',
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
            'document' => 'required|max:13',
            'name' => 'required|max:250',
            'last_name' => 'nullable|max:250',
            'address' => 'nullable',
            'phone' => 'nullable|max:10',
            'email' => 'nullable|email',
        ];
    }
}
