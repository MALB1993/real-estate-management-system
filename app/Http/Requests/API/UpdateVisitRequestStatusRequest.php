<?php

namespace App\Http\Requests\API;

use App\Enums\VisitRequestStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateVisitRequestStatusRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'status'        => ['required', new Enum(VisitRequestStatus::class)],
            'agent_note'    => ['nullable', 'string', 'max:500'],
        ];
    }
}
