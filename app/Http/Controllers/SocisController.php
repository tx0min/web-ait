<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Corcel\Model\Taxonomy;
use Exception;

class SocisController extends Controller
{



    public function disciplina($disciplina){
        return $this->socis($disciplina);
    }



    public function socis($disciplina=null, $term=null){

        $disciplines= Taxonomy::where('taxonomy', 'disciplines')->get();


        $users=User::select();

        if($disciplina){
            $users = $users->taxonomy('disciplines', $disciplina);
        }

        if($term){
            $users=$users->byTerm($term);
        }

        $users=$users->socis()->simplePaginate(20);

        return view('socis', compact('users','disciplines','disciplina','term'));

    }


    public function soci($soci_slug){
        $user=User::getBySlug($soci_slug);
        return view('soci', compact('user'));
    }


    public function search(Request $request){
        return $this->socis($request->disciplina, $request->term);

    }



}
