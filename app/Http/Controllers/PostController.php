<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Posts::orderBy('created_at','desc')->paginate(5);
        for ($i=0; $i < count($posts); $i++) { 
            $posts[$i]->author = User::find($posts[$i]->user_id)->name;
        }
        return view('pages.posts')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      => 'required|unique:posts|max:255',
            'body'       => 'required',
            'category'   => 'required',
            'header_image' => 'image|nullable|max:20480'
        ]);
        
        if($request->hasFile('header_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('header_image')->getClientOriginalName();
            $fileName = str_replace(' ', '_', $filenameWithExt);
            // Get just filename
            $filename = pathinfo($fileName, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('header_image')->getClientOriginalExtension();
            // Filename to store
            $storeImage = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('header_image')->storeAs('/public/post_header', $storeImage);
        } else {
            $storeImage = 'noimage.png';
        }
        $post = new Posts;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category = $request->input('category');
        $post->anonymous = $request->input('anonymous');
        $post->header_image = $storeImage;
        $post->user_id = auth()->id();
        $user_id = auth()->id();
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Posts::find($id);
        $posts->author = User::find($posts->user_id)->name;
        return view('pages.post')->with('posts',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }
        if(auth()->id() !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('pages.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'      => 'required|max:255',
            'body'       => 'required',
            'category'   => 'required',
            'header_image' => 'image|nullable|max:20480'
        ]);
        
        if($request->hasFile('header_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('header_image')->getClientOriginalName();
            $fileName = str_replace(' ', '_', $filenameWithExt);
            // Get just filename
            $filename = pathinfo($fileName, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('header_image')->getClientOriginalExtension();
            // Filename to store
            $storeImage = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('header_image')->storeAs('/public/post_header', $storeImage);
            $post = Posts::find($id);
            if(is_file($post->header_image)){
                unlink(storage_path('app/public/post_header/'.$post->header_image));
            }
            else{
                Storage::delete('public/post_header'.$post->header_image);
    
            }        
        } 
        else {
            $post = Posts::find($id);
            $storeImage = $post->header_image;
        }
            $post = Posts::find($id);
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->category = $request->input('category');
            $post->anonymous = $request->input('anonymous');
            $post->header_image = $storeImage;
            $post->save();

            $name = auth()->user()->name;
            return redirect()->route('dashboard',$name)->with('success', 'Post Upadted');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Posts::find($id);
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        if(is_file($post->header_image)){
            unlink(storage_path('app/public/post_header/'.$post->header_image));
        }
        else{
            Storage::delete('public/post_header'.$post->header_image);

        }
        $post->delete();
        $name = auth()->user()->name;
        return redirect()->route('dashboard',$name)->with('success', 'Post Removed');

    }
}
