<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class SociValidate extends BaseRequest
{
    
    public function rules()
    {
        return [
            'first_name' => ['required'],
            // 'nickname' => ['required','min:2']
        ];
    }

}
