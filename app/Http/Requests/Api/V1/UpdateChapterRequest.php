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
                'title' => ['required', 'string'],
                'public' => ['required', 'boolean'],
                'blockIds' => ['required', 'array'],
                'blockIds.*' => ['required', 'string', 'exists:blocks,block_nanoid_10'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'required', 'string'],
                'public' => ['sometimes', 'required', 'boolean'],
                'blockIds' => ['sometimes', 'required', 'array'],
                'blockIds.*' => ['sometimes', 'required', 'string', 'exists:blocks,block_nanoid_10'],
            ];
        }

    }

    protected function passedValidation()
    {
        if ($this->blockIds) {
            $this->merge([
                'block_ids' => $this->blockIds,
            ]);
        }
    }
}
