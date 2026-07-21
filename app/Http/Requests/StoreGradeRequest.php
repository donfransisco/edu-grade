<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'nilai' => ['required', 'numeric', 'between:0,100'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
            'tahun_akademik' => ['required', 'string', 'max:9'],
        ];
    }
}
