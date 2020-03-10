<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class FesteSociValidate extends BaseRequest
{
    
    public function rules()
    {
        // dd(request()->disciplines);
        return [
            'first_name' => ['required'],
            'email' => ['required','email'],
            'data_naixement' => ['required','date_format:d/m/Y'],
            'disciplines' => ['required'],
            // 'new_password' => ['nullable','min:6','confirmed']
        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Cal que emplenis el nom',
            'email.required' => 'Cal que emplenis el correu electrònic',
            'email.email' => 'El correu electrònic no és vàlid',
            'data_naixement.required' => 'Cal que emplenis la data de naixement',
            'data_naixement.date_format' => 'Introdueix una data de naixement vàlida en format dd/mm/any',
            // 'nickname.min'  => 'L'a',
            'disciplines.required'  => 'Tria com a mínim una disciplina',
            // 'new_password.min'  => 'La contrasenya ha de tenir un mínim de 6 caràcters',
            // 'new_password.confirmed'  => 'La contrasenya no coincideix',
        ];
    }

}
