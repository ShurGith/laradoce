<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],
            'active' => ['required'],
            'oferta' => ['required'],
            'descuento' => ['nullable', 'integer'],
            'units' => ['nullable', 'integer'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
