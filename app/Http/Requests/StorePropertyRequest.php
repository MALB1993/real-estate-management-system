<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users to make this request. Adjust as needed for your application.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // validation rules for the property creation request
        return [
            'property_type_id'  => ['required', 'integer', 'exists:property_types,id'],
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'price'             => ['required', 'numeric', 'min:0'],
            'area'              => ['required', 'numeric', 'min:0'],
            'bedrooms'          => ['required', 'integer', 'min:0'],
            'bathrooms'         => ['required', 'integer', 'min:0'],
            'address'           => ['required', 'string', 'string'],
            'city'              => ['required', 'string', 'string', 'max:255'],
            'state'             => ['required', 'string', 'in:available,sold,reserved'],
        ];
    }
}
