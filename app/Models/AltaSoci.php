<?php

namespace App\Models;

use Corcel\Model\Taxonomy;
use Illuminate\Support\Str;

class AltaSoci 
{
    public $first_name;
    public $last_name;
    public $email;
    public $telefon;
    public $data_naixement;
    public $localitat;
    public $adreca;
    public $disciplines;

    
    public function __construct($attributes = [])
    {
        // dd($attributes);
        $this->first_name = $attributes['first_name'] ?? null;
        $this->last_name = $attributes['last_name'] ?? null;
        $this->email = $attributes['email'] ?? null;
        $this->telefon = $attributes['telefon'] ?? null;
        $this->data_naixement = $attributes['data_naixement'] ?? null;
        $this->localitat = $attributes['localitat'] ?? null;
        $this->adreca = $attributes['adreca'] ?? null;
        
        if($attributes['disciplines']){
            $this->disciplines =[];
            foreach($attributes['disciplines'] as $disciplina_id){
                $disciplina=Taxonomy::find($disciplina_id);
                if($disciplina) $this->disciplines[]=$disciplina;
            }
        }
        // dd($this);
    }
}