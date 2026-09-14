<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_type_id' => ['sometimes', 'integer', 'exists:property_types,id'],
            'title'            => ['sometimes', 'string', 'max:255'],
            'description'      => ['sometimes', 'string'],
            'price'            => ['sometimes', 'numeric', 'min:0'],
            'area'             => ['sometimes', 'numeric', 'min:0'],
            'bedrooms'         => ['sometimes', 'integer', 'min:0'],
            'bathrooms'        => ['sometimes', 'integer', 'min:0'],
            'address'          => ['sometimes', 'string'],
            'city'             => ['sometimes', 'string', 'max:255'],
            'state'            => ['sometimes', 'string', 'in:available,sold,reserved'],
        ];
    }
}
