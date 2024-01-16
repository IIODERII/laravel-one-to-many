<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|min:3|max:100|unique:projects',
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
            'title.required' => 'Il campo :attribute è obbligatorio',
            'url.required' => 'Il campo :attribute è obbligatorio',
            'image.image' => 'Il campo :attribute deve essere un immagine',
            'url.url' => 'Il campo :attribute deve essere un url',
            'title.min' => 'Il campo :attribute deve avere almeno :min caratteri',
            'description.min' => 'Il campo :attribute deve avere almeno :min caratteri',
            'title.max' => 'Il campo :attribute deve avere almeno :max caratteri',
            'title.unique' => 'Il campo :attribute esiste già',
        ];
    }
}
