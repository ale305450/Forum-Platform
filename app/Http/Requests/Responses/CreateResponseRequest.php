<?php

namespace App\Http\Requests\Responses;

use app\Core\DTOs\Responses\CreateResponseDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateResponseRequest extends FormRequest
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
            'topic_id' => ['required'],
            'content' => ['required', 'min:3'],
            'parent_id' => ['nullable'],
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

    public function toDto(): CreateResponseDto
    {
        return new CreateResponseDto($this->topic_id, $this->content, $this->parent_id);
    }
}
