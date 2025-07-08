<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerpApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'domain' => 'required|string|max:255',
            'keyword' => 'required|string|min:2|max:255',
            'timezone' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'domain.required' => 'Lütfen bir domain (alan adı) giriniz.',
            'domain.string' => 'Domain alanı metin (string) formatında olmalıdır.',
            'domain.max' => 'Domain en fazla 255 karakter olabilir.',
            'keyword.required' => 'Lütfen bir anahtar kelime giriniz.',
            'keyword.string' => 'Anahtar kelime metin (string) formatında olmalıdır.',
            'keyword.min' => 'Anahtar kelime en az 2 karakter olabilir.',
            'keyword.max' => 'Anahtar kelime en fazla 255 karakter olabilir.',
            'timezone.string' => 'Zaman dilimi geçerli bir metin olmalıdır.',
            'timezone.max' => 'Zaman dilimi en fazla 255 karakter olabilir.',
        ];
    }

}
