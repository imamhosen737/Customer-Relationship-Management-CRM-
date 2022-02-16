<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksRequest extends FormRequest
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
            'project_id' => 'required',
            'user_id' => 'required',
            'milestone_id' => 'required',
            'subject' => 'required',
            'duration' => 'required',
            'status' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'end_date' => 'required',
            'priority' => 'required',
           
        ];
    }
}
