<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validation extends FormRequest {
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
        $rules = [
            'test_title'  => ['required'],
            'subject'  => ['required'],
            'question1' => ['required'],
            'model_answer1'  => ['required'],
        ];
        return $rules;
    }
}
?>