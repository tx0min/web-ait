<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class SociValidate extends BaseRequest
{
    
    public function rules()
    {
        // dd(request()->disciplines);
        return [
            'first_name' => ['required'],
            'disciplines' => ['required']
        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Cal que emplenis el nom',
            // 'nickname.min'  => 'L'a',
            'disciplines.required'  => 'Tria com a mínim una disciplina',
        ];
    }

}
