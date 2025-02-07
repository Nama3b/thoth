<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class DocumentCreateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:10000',
            'user' => 'integer',
            'folder' => 'integer',
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
