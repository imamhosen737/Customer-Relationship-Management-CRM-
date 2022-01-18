<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
            'name'  => 'required',
            'email' => 'required|email|unique:leads',
            'phone' => 'required|numeric|unique:leads',
            'address' =>'required',
            'service_interest' =>'required',
        ];
    }

    public function persist()
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' =>$this->address,
            'service_interest' =>$this->service_interest,
            'user_id' => $this->user_id,
        ];
        
    }
}
