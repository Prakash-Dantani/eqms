<?php

namespace App\Http\Requests\DMS;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('document_type');

        return [

            'document_type_name' => [
                'required',
                'max:255'
            ],

            'document_type_code' => [

                'required',

                'max:50',

                Rule::unique('document_types', 'document_type_code')
                    ->ignore($id)

            ],

            'description' => [
                'nullable'
            ],

            'status' => [
                'required',
                'boolean'
            ]

        ];
    }
}
