<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Rules\UniqueUsername;

class FesteSociValidate extends BaseRequest
{

    public function rules()
    {
        // dd(request()->disciplines);
        return [
            'user_login' => ['required','alpha_dash','min:3','max:25', new UniqueUsername],
            'first_name' => ['required'],
            'user_email' => ['required','email'],
            'data_naixement' => ['required','date_format:d/m/Y'],
            'disciplines' => ['required'],
            'password' => ['required','min:6','confirmed']
        ];
    }


    public function messages()
    {
        return [
            'user_login.required' => 'Cal que emplenis el nom d\'usuari',
            'user_login.alpha_dash' => 'Caràcters no permesos. Només números, lletres i guions.',
            'user_login.min' => 'El nom d\'usuari ha de tenir 3 caràcters com a mínim.',
            'user_login.max' => 'El nom d\'usuari ha de tenir 25 caràcters com a màxim.',
            'first_name.required' => 'Cal que emplenis el nom',
            'user_email.required' => 'Cal que emplenis el correu electrònic',
            'user_email.email' => 'El correu electrònic no és vàlid',
            'data_naixement.required' => 'Cal que emplenis la data de naixement',
            'data_naixement.date_format' => 'Introdueix una data de naixement vàlida en format dd/mm/any',
            'disciplines.required'  => 'Tria com a mínim una disciplina',
            'password.required'  => 'Cal que emplenis la contrasenya.',
            'password.min'  => 'La contrasenya ha de tenir un mínim de 6 caràcters',
            'password.confirmed'  => 'La contrasenya no coincideix',
        ];
    }

}
