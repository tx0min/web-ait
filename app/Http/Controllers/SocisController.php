<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Corcel\Model\Taxonomy;
use Exception;
use Cache;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

class SocisController extends Controller
{



    // public function disciplina($disciplina){
    //     return $this->socis($disciplina);
    // }



    public function socis($disciplina=null, Request $request){


        $pagesize=12;
        $page = Paginator::resolveCurrentPage() ?? 1;

        $hash='users-pagesize-'.$pagesize;


        $disciplina=$disciplina?$disciplina:(($request->has('disciplina') && $request->disciplina)?$request->disciplina:null);
        if($disciplina){
            $hash.='-disciplina:'.$disciplina;
        }

        $term=null;
        if($request->has('term') && $request->term){
            $term=$request->term;
            $hash.='-user:'.$request->term;
        }

        //limio la url si no hay valores
        if($request->has('disciplina') && !$disciplina && $request->has('term') && !$term) return redirect()->route('socis');
        if($request->has('disciplina') && $disciplina && $request->has('term') && !$term) return redirect()->route('socis',['disciplina'=>$disciplina]);
        if($request->has('disciplina') && $disciplina && !$request->has('term')) return redirect()->route('socis',['disciplina'=>$disciplina]);
        if($request->has('disciplina') && $disciplina && $request->has('term') && $term) return redirect()->route('socis',['disciplina'=>$disciplina,'term'=>$term]);
        if($request->has('disciplina') && !$disciplina && $request->has('term') && $term) return redirect()->route('socis',['term'=>$term]);
        //if($request->has('disciplina') && $disciplina && !$request->has('term')) return redirect('socis',['disciplina'=>$disciplina]);

        //dump($hash);
        $hash=md5($hash);

        $users=Cache::remember($hash, 360, function () use($disciplina, $term){
            //1 hora
            $usersQuery=User::select();

            if($disciplina){
                $usersQuery = $usersQuery->taxonomy('disciplines', $disciplina);
            }

            if($term){
                $usersQuery=$usersQuery->byTerm($term);
            }
            $usersQuery=$usersQuery->socis()->inRandomOrder();
            $users = $usersQuery->get();
            //dd($users);
            return $users;
        });


        $users = new LengthAwarePaginator($users->forPage($page, $pagesize), $users->count(), $pagesize, $page, ['path' => $request->url()]);
        $disciplines = Taxonomy::where('taxonomy', 'disciplines')->get();

        return view('socis', compact('users','disciplines','disciplina','term'));

    }


    public function soci($soci_slug){
        $user=User::getBySlug($soci_slug);
        return view('soci', compact('user'));
    }

    public function flush(){
        Artisan::call("cache:clear");
        return redirect()->route('socis');
    }


    // public function search(Request $request){
    //     $args=[];
    //     if($request->disciplina) $args['disciplina']=$request->disciplina;
    //     if($request->term) $args['term']=$request->term;
    //     return redirect()->route('socis',$args);
    // }



}
