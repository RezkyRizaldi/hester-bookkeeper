<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
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
            'store_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'amount' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => str_replace(',', '', $this->amount),
        ]);
    }
}
