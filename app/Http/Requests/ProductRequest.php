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
        foreach ($this->incoming as $key => $value) {
            $incoming["incoming.{$key}"] = ['required', 'integer', "gte:outgoing.{$key}"];
        }

        return array_merge([
            'brand_id' => ['required', 'integer'],
            'color_id' => ['required', 'integer'],
            'name' => ['required', 'max:255', 'string'],
            'capital' => ['required', 'string'],
            'price' => ['required', 'string'],
            'size' => ['required', 'string', 'max:255'],
        ], $incoming);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        foreach ($this->incoming as $key => $value) {
            $incoming["incoming.{$key}"] = 'incoming';
        }

        return array_merge([
            'brand_id' => 'brand',
            'color_id' => 'color',
        ], $incoming);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'capital' => str_replace(',', '', $this->capital),
            'price' => str_replace(',', '', $this->price),
            'size' => is_array($this->size) ? implode(',', $this->size) : (string) $this->size,
        ]);
    }
}
