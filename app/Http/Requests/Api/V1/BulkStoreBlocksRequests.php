<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreBlocksRequests extends FormRequest
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
            'chapterId' => ['required', 'int', 'exists:chapters,chapter_id'],
            'blocks' => ['required', 'array'],
            'blocks.*.id' => ['required', 'string', 'max:10', 'min:10'],
            'blocks.*.typeId' => ['required', 'int', 'exists:block_types,block_type_id'],
            'blocks.*.data' => ['required'],
            'blocks.*.data.version' => ['required', 'string', 'max:10', 'min:5'],
            'blocks.*.wordCount' => ['required', 'int', 'min:0'],
        ];
    }

    protected function prepareForValidation() {
        $this->merge(['chapterId' => $this->route('chapterId')]);
    }

    protected function passedValidation(): void {
        $new_blocks = [];

        foreach ($this->blocks as $block) {
            $block['block_nanoid_10'] = $block['id'];
            $block['block_type_id'] = $block['typeId'];
            $block['word_count'] = $block['wordCount'];
            $block['data'] = json_encode($block['data']);

            $new_blocks[] = $block;
        }
        $this->merge(['blocks' => $new_blocks]);
    }
}