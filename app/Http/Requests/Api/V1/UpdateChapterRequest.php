<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
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
        $method = $this->method();
        if ($method === 'PUT') {
            return [
                'title' => ['required'],
                'coverId' => ['required', 'integer', 'exists:covers,cover_id']
            ];
        } else {
            return [
                'title' => ['sometimes', 'required'],
                'coverId' => ['sometimes', 'required', 'integer', 'exists:covers,cover_id']
            ];
        }

    }

    protected function passedValidation()
    {
        if ($this->coverId) {
            $this->merge([
                'cover_id' => $this->coverId
            ]);
        }
    }
}
