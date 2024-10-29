<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
    {        return [
            'title' =>'required|string|max:50',
            'description'=>'required|string|max:2000|min:20',
            'due_date'=>'required|date',
            'status'=>'required|in:pending,completed',
            'user_id'=>'required|integer'
        ];
    }
}
