<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video_url' => 'nullable|url',
            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.type' => 'required|in:text,image,video,link',
            'modules.*.contents.*.value' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Course title is required.',
            'modules.required' => 'At least one module is required.',
            'modules.*.title.required' => 'Module title is required.',
            'modules.*.contents.required' => 'Each module must have at least one content.',
            'modules.*.contents.*.type.required' => 'Content type is required.',
            'modules.*.contents.*.value.required' => 'Content value is required.',
        ];
    }
}
