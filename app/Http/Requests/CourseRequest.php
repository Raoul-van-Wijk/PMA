<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_name' => 'required',
            'description' => 'required',
            'education' => 'required',
            'year' => 'required|size:1',
            'semester' => 'required|size:1',
            'period' => 'required|size:1',
            'startYear' => 'required|size:4',
        ];
    }
}
