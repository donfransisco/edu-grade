<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nim' => ['required', 'string', 'max:20', 'unique:students,nim'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'program_studi' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'digits:4', 'integer', 'min:2000', 'max:'.date('Y')],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
