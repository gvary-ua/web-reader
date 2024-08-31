<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoverRequest extends FormRequest
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
        // TODO: full PUT
        if ($method === 'PUT') {
            return [
                'cover_id' => ['required', 'integer', 'exists:covers,cover_id'],
                'title' => ['required', 'string'],
            ];
            // TODO: full PATCH
        } else {
            return [
                'cover_id' => ['required', 'integer', 'exists:covers,cover_id'],
                'title' => ['sometimes', 'required', 'string'],
            ];
        }

    }

    protected function prepareForValidation()
    {
        $this->merge(['cover_id' => $this->route('coverId')]);
    }
}
