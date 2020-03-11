<?php

namespace App\Models;

use App\User;
use Corcel\Model\Taxonomy;
use Illuminate\Support\Str;

class AltaSoci
{
    public $user_login;
    public $password;
    public $first_name;
    public $last_name;
    public $user_email;
    public $telefon;
    public $data_naixement;
    public $localitat;
    public $adreca;
    public $disciplines;
    public $disciplines_id;


    public function __construct($attributes = [])
    {
        // dd($attributes);
        $this->user_login = $attributes['user_login'];
        $this->password = $attributes['password'];
        $this->first_name = $attributes['first_name'] ?? null;
        $this->last_name = $attributes['last_name'] ?? null;
        $this->user_email = $attributes['user_email'] ?? null;
        $this->telefon = $attributes['telefon'] ?? null;
        $this->data_naixement = $attributes['data_naixement'] ?? null;
        $this->localitat = $attributes['localitat'] ?? null;
        $this->adreca = $attributes['adreca'] ?? null;

        if($attributes['disciplines']){
            $this->disciplines =[];
            $this->disciplines_id =[];
            foreach($attributes['disciplines'] as $disciplina_id){
                $disciplina=Taxonomy::find($disciplina_id);
                if($disciplina) $this->disciplines[]=$disciplina;

                $this->disciplines_id[]=$disciplina_id;
            }
        }
        // dd($this);
    }

    //crea l'usuari a Wordpress
    public function save(){
        //creo el usuario
        $ret=User::createUser([
            'username' => $this->user_login,
            'password' => $this->password,
            'email' => $this->user_email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);


        //campos ACF
        $user=User::slug($this->user_login)->first();
        $user->setACFields([
            'soci_email' => $this->user_email,
            'localitat' => $this->localitat,
            'adreca' => $this->adreca,
            'data_naixement' => $this->data_naixement,
            'telefon' => $this->telefon,
            'disciplines' => $this->disciplines_id
        ]);

        // die();
        // dd($user);
    }
}
