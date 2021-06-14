<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingController extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'repetition' => 'required|integer',
            'weight' => 'required|numeric',
            'workout_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'repetition.required' => 'Počet opakování musí být zadán.',
            'repetition.integer' => 'Počet opakování musí být celé číslo.',
            'weight.required' => 'Váha musí být zadaná.',
            'weight.numeric' => 'Váha musí být číslo..',
            'workout_id.required' => 'Název cviku musí být zadaný.'
        ];
    }
}
