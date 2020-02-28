<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Corcel\Model\Post;
use App\User;
use Corcel\Acf\Field\Image;
use Corcel\Model\Taxonomy;
use Exception;

class WebController extends Controller
{

    public function home()
    {
        // $images=Post::type('page')->published()->get();
        $page=Post::slug(config('ait.pages.home'))->first();
        $behaviour = $page->acf->behaviour;
        $slides=$page->acf->repeater('images');
        // dd($behaviour);
        $slide=null;

        if($behaviour=="random"){
            $index=mt_rand(0,$slides->count()-1);
            // dump($index);
            $slides = $slides->slice($index,1);


        }
        // dd($slides);
        // dd($images);
        return view('home', compact('slides','behaviour'));
    }


    public function socis($soci_slug=null){
        if($soci_slug){
            $user=User::getBySlug($soci_slug);
            return view('soci', compact('user'));
        }else{

            $disciplines= Taxonomy::where('taxonomy', 'disciplines')->get();
            
            $current_disciplina=session('disciplina',0);
            
            $users=User::select();
            
            if($current_disciplina){
                $users = $users->taxonomy('disciplines', $current_disciplina);
            }
            // dump(fullquery($users));
            $term=session('term','');

            if($term){
                $users=$users->byTerm($term);
            }
            
            $users=$users->socis();

            return view('socis', compact('users','disciplines','current_disciplina','term'));
        }
    }

    public function search(Request $request){
        session([
            'disciplina'=>$request->disciplina,
            'term'=>$request->term
        ]);

        return redirect('socis');
    
    }


    public function blog($post_slug=null){
        if($post_slug){
            $post=Post::slug($post_slug)->first();
            if(!$post) abort(404);
            return view('post', compact('post'));
        }else{
            $posts=Post::type('post')->published()->paginate();
            return view('blog', compact('posts'));
        }
    }

    public function associacio(){
        $users=User::junta();
        $page=Post::slug(config('ait.pages.associacio'))->first();
        return view('associacio', compact('page','users'));
    }

    public function festeSoci(){

        $page=Post::slug(config('fes-te-soci'))->first();

        return view('fes-te-soci',compact('page'));
    }
}
