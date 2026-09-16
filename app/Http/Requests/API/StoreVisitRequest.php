<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
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
            'property_id'           => ['required', 'exists:properties,id'],
            'preferred_date'        => ['required', 'date', 'after_or_equal:today'],
            'preferred_time_slot'   => ['required', 'string', 'max:50'],
            'note'                  => ['nullable', 'string', 'max:500'],
        ];
    }
}
