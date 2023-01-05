<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand_id' => ['required', 'integer'],
            'name' => ['required', 'max:255', 'string'],
            'capital' => ['required', 'string'],
            'price' => ['required', 'string'],
            'size' => ['required', 'max:5', 'string'],
            'color' => ['required', 'max:255', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'capital' => str_replace(',', '', $this->capital),
            'price' => str_replace(',', '', $this->price),
        ]);
    }
}
