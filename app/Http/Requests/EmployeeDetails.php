<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeDetails extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'empId' => 'required',
            'role' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'bloodGroup' => 'required',
            'dob' => 'required',
            'doj' => 'required'
        ];
    }
}
