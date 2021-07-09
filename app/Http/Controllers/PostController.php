<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\PostRequest; 
use App\Comment;
use Storage;



class PostController extends Controller
{
    
  

public function create(Post $post,Request $request)
{
    
      return view('posts.create');
 
}

  public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->get()]);  
      
    }
    
    public function store(Request $request)
    {
        
      $post = new Post;
      $form = $request->all();

      //s3アップロード開始
      $image = $request->file('image');
      
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);
      $post->title = $request->title;

      $post->save();
        return redirect('/posts/' . $post->id);
        
    }
        
        
    
  public function show(Post $post,Comment $comment)
  {
     $posts = Post::all();
     
      return view('posts.show')->with(['post' => $post,'comments' => $comment->get()]);
      
  }
     
  public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}   

public function update(Request $request)
{
    // $input_post = $request['post'];
    // $post->fill($input_post)->save();

    // return redirect('/posts/' . $post->id);
    
      $post = new Post;
      $form = $request->all();

      //s3アップロード開始
      $image = $request->file('image');
      
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);
      $post->title = $request->title;

      $post->save();
        return redirect('/posts/' . $post->id);
}

public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}
}
