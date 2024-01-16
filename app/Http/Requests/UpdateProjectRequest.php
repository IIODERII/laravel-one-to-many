<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'max:100', Rule::unique('projects')->ignore($this->project)],
            'description' => 'nullable|min:3',
            'image' => 'nullable|image',
            'url' => 'required|url',
            'tecnologies' => 'nullable',
            'category_id' => 'nullable |exists:categories,id',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Il campo :attribute è obbligatorio',
            'url' => 'Il campo :attribute deve essere un url',
            'min' => 'Il campo :attribute deve avere almeno :min caratteri',
            'max' => 'Il campo :attribute deve avere almeno :max caratteri',
            'unique' => 'Il campo :attribute deve essere unico',
            'image' => 'Il campo :attribute deve essere un immagine',
        ];
    }
}
