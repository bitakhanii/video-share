<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreVideoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'slug' => ['required', 'unique:videos', 'alpha_dash'],
            'file' => ['required', 'file', 'mimes:avi,mkv,mp4'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }

    public function messages()
    {
        return [
            'file.*' => 'فایل باید معتبر باشد.'
        ];
    }
}
