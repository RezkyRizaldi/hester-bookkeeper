<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $words = explode(' ', $this->name);
        $acronym = '';

        foreach ($words as $word) {
            $acronym .= mb_substr($word, 0, 1);
        }

        $this->merge([
            'code' => $acronym,
        ]);
    }
}
