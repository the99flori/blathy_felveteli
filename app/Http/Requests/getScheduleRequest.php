<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getScheduleRequest extends FormRequest
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
            'eduId' => 'required|numeric|digits:11',
            'born' => 'required|date',
            'sign' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'eduId.required' => 'Kötelező kitölteni!',
            'eduId.numeric' => 'Csak számokat tartalmazhat!',
            'eduId.digits' => '11 számjegyből kell állnia!',
            'born.required' => 'Kötelező kitölteni!',
            'born.date' => 'Dátum kell, hogy legyen!',
        ];
    }

}
