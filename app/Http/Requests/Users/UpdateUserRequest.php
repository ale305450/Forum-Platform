<?php

namespace App\Http\Requests\Users;

use app\Core\DTOs\Users\UpdateUserDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends FormRequest
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
            'name' => ['string','required'],
            'password' => ['required'],
            'profile_picture' => ['file', 'mimes:png,jpg']
        ];
    }

    /**
     * Get the validation errors that may accure in the request.
     *
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }

    /**
     * Link the DTO with the request.
     *
     */

    public function toDto(): UpdateUserDto
    {
        return new UpdateUserDto($this->name, $this->password, $this->file('profile_picture'));
    }
}
