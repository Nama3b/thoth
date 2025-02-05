<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class DocumentListRequest extends FormRequest
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
