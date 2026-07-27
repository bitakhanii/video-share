<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TwoFactorAuthRequest extends FormRequest
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
            'code' => ['required', 'numeric', 'digits:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.digits' => 'کد وارد شده نامعتبر است.'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $failed = $validator->failed();

        if (isset($failed['code']['Digits'])) {
            Alert::error(__('کد نامعتبر است.'))
                ->showConfirmButton('باشه')
                ->autoClose(3000);

            throw new HttpResponseException(
                redirect()->back()
            );
        }

        parent::failedValidation($validator);
    }
}
