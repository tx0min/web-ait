<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Corcel\Model\Post;
use Corcel\Model\User;
use Corcel\Acf\Field\Image;

class WebController extends Controller
{
    
    public function home()
    {
        
        return view('home');
    }
    
    public function socis($soci_slug=null){
        if($soci_slug){
            $user=User::where('user_nicename',$soci_slug)->first();
            if(!$user) abort(404);
            return view('soci', compact('user'));
        }else{
            $users=User::get();
            return view('socis', compact('users'));
        }
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
        $page=Post::slug('associacio')->first();
        return view('associacio', compact('page'));
    }

    public function festeSoci(){

        $page=Post::slug('fes-te-soci')->first();
        
        return view('fes-te-soci',compact('page'));
    }
}
