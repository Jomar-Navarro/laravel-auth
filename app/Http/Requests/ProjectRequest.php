<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'project_url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo del progetto è obbligatorio.',
            'title.max' => 'Il titolo del progetto non può superare i 255 caratteri.',
            'description.required' => 'La descrizione del progetto è obbligatoria.',
            'project_url.required' => 'L\'URL del progetto è obbligatorio.',
            'project_url.url' => 'L\'URL del progetto deve essere un URL valido.',
            'image.image' => 'L\'immagine deve essere un file immagine.',
            'image.mimes' => 'L\'immagine deve essere di uno dei seguenti formati: jpeg, png, jpg, gif.',
            'image.max' => 'L\'immagine non può superare i 2 MB di dimensioni.',
        ];
    }
}
