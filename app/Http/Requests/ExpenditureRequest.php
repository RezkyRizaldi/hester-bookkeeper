<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenditureRequest extends FormRequest
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
            'product_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'price' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => str_replace(',', '', $this->price),
        ]);
    }
}
