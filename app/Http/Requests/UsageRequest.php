<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsageRequest extends BaseRequest
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
            'description' => 'required',
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
            'description' => 'required',
        ];
    }
}
