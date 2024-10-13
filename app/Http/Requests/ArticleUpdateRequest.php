<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
     * @return array<string, array<mixed>|\Illuminate\Contracts\Validation\ValidationRule|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:articles,title,'.$this->route('article')->id,
            'published_at' => 'nullable|date',
            'body' => 'required|string',
            'img' => 'nullable|image|max:2048',
        ];
    }
}
