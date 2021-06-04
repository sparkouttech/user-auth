<?php

namespace Sparkouttech\UserAuth\app\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => 'required',
            'verifyPassword' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [];
    }

}
