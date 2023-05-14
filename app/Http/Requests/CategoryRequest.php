<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:255', Rule::unique('categories', 'name')->ignore($this->route('category'))],
            'slug' => ['required', 'max:255', Rule::unique('categories', 'slug')->ignore($this->route('category'))],
        ];
    }
}
