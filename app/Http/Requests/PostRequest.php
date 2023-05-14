<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', Rule::unique('posts', 'title')->ignore($this->route('post'))],
            'description' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
