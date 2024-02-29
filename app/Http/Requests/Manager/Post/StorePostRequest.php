<?php

namespace App\Http\Requests\Manager\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'main_image' => 'required|file',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'This field must be filled',
            'title.string' => 'This data must be string type',
            'content.required' => 'This field must be filled',
            'content.string' => 'This data must be string type',
            'preview_image.required' => 'This field must be filled',
            'preview_image.file' => 'Choose a file',
            'main_image.required' => 'This field must be filled',
            'main_image.file' => 'Choose a file',
            'category_id.required' => 'This field must be filled',
            'category_id.integer' => 'Comment id must be a number',
            'category_id.exists' => 'Comment id must be in a database',

        ];
    }
}
