<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
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
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:1500',
        ];
    }
  
    public function messages()
    {
        return [
            'title.required' => '上記は必須項目です。',
            'title.string' => '文字で入力してください。',
            'title.max' => '50文字以内で入力してください。',
            'content.required' => '上記は必須項目です。',
            'content.string' => '文字で入力してください。',
            'content.max' => '1500文字以内で入力してください。',
        ];
    }
}

