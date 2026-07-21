<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLecturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $lecturerId = $this->route('lecturer')?->id;

        return [
            'nidn' => ['required', 'string', 'max:20', Rule::unique('lecturers', 'nidn')->ignore($lecturerId)],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('lecturers', 'email')->ignore($lecturerId)],
            'telepon' => ['nullable', 'string', 'max:20'],
            'program_studi' => ['required', 'string', 'max:100'],
        ];
    }
}
