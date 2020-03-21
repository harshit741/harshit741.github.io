<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\User;

class PagesController extends Controller
{
    public function getHome() {

        $posts = Posts::orderBy('created_at','desc')->paginate(5);
        for ($i=0; $i < count($posts); $i++) { 
            $posts[$i]->author = User::find($posts[$i]->user_id)->name;
        }
        return view('pages.home')->with('posts',$posts);
    }

    public function getAbout() {

        return view('pages.about');
    }

    public function getContact() {

        return view('pages.contact');
    }

    public function category($category) {

        $posts = Posts::orderBy('created_at','desc')->where('category',$category)->paginate(5);
        for ($i=0; $i < count($posts); $i++) { 
            $posts[$i]->author = User::find($posts[$i]->user_id)->name;
        }
        return view('pages.category')->with('posts',$posts)->with('category',$category);
    }

    public function dashboard($name){
        $profile = User::where('name', $name)->get();
        // for ($i=0; $i < count($name); $i++) { 
        //     $name[$i]->author = User::find($name[$i]->id)->name;
        // }
        $uid =  $profile[0]->id;
        $posts = Posts::orderBy('created_at','desc')->where('user_id',$uid)->paginate(5);
        // for ($i=0; $i < count($posts); $i++) { 
        //     $posts[$i]->author = User::find($posts[$i]->user_id)->name;
        // }
        return view('pages.dashboard')->with('posts', $posts);
        // return $posts;
    }
    public function author($author){
        $profile = User::where('name', $author)->get();
        $uid =  $profile[0]->id;
        $posts = Posts::orderBy('created_at','desc')->where('user_id',$uid)->paginate(5);
        return view('pages.author')->with('posts', $posts)->with('name',$author);

    }
}


?>