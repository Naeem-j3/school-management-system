<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorStudentRequest extends FormRequest
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
        $studentId = $this->route('student');
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->ignore($studentId),
            ],
            'password' => 'required|string',
            'gender' => 'required|in:m,f',
            'birth_date' => 'required|date|date_format:Y-m-d',
            'nationality_id' => 'required|exists:nationalities,id',
            'blood_id' => 'required|exists:bloods,id',
            'religion_id' => 'required|exists:religions,id',
            'grade_id' => 'required|exists:grades,id',
            'class_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'required|exists:the_parents,id',
            'academic_year' => 'required|string',
        ];
    }
}
