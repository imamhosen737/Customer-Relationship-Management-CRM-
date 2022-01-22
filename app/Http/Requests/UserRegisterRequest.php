<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
            'department_id' => 'required',
        ];
    }

    /**
     * return request values
     *
     * @return array
     */
    public function persist()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
            'status' => $this->status,
            'department_id' => $this->department_id,
        ];
    }
}
