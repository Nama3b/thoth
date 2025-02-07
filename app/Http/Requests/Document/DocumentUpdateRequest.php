<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class DocumentUpdateRequest extends FormRequest
{
    /**
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([])] public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:10000',
            'folder' => 'nullable|integer',
        ];
    }

    /**
     * Customize messages
     *
     * @return array
     */
    #[ArrayShape([])] public function messages(): array
    {
        return [
            'required' => __("validation.required"),
        ];
    }
}
