<?php

namespace App\Http\Requests\DMS;

use Illuminate\Foundation\Http\FormRequest;

class DocumentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'category_name' => 'required|string|max:255',

            'category_code' => 'required|string|max:50|unique:document_categories,category_code,' . $this->route('document_category'),

            'description' => 'nullable|string',

            'status' => 'required|boolean',

        ];
    }
}
