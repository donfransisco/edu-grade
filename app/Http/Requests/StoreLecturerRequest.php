<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLecturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nidn' => ['required', 'string', 'max:20', 'unique:lecturers,nidn'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:lecturers,email'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'program_studi' => ['required', 'string', 'max:100'],
        ];
    }
}
