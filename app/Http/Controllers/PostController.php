<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Post;
use App\Http\Requests\PostRequest; 
use App\Comment;
use Storage;
use Auth;


class PostController extends Controller
{
    
  

public function create(Post $post,Request $request)
{
    
      return view('posts.create');
 
}

  public function index(Post $post,Request $request)
    {
        $keyword = $request->keyword;
        
        if(!empty($keyword)) {
 
            $post = DB::table('posts')->where('title', 'LIKE', '%'.$keyword.'%');
            
            return view('posts.index')->with(['posts' => $post->paginate(5),'keyword'=>$keyword]);
        }else{
           return view('posts.index')->with(['posts' => $post->getPaginateByLimit(),'keyword'=>$keyword]);
        }
    }
    
    
    public function store(Request $request)
    {
      $post = new Post;
      $form = $request->all();
      
      if($request->file('image') == null){
        $image = null;
      }else{
      //s3アップロード開始
      $image = $request->file('image');
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);  
      // AmazonS3のパスを取得
      $post->s3_path = $path;
      }
      // タイトルを取得
      $post->title = $request->title;
      // ログインしているユーザーのUser_idを取得
      $post->user_id = Auth::id();
      $post->save();
      return redirect('/posts/' . $post->id);
    }
        
        
    
  public function show(Post $post,Comment $comment,Request $request)
  {
    $keyword = $request->keyword;
    
    if(!empty($keyword)){
      
      $comment = DB::table('comments')->where('post_id', $post->id)->where('body', 'LIKE', '%'.$keyword.'%');
      
      return view('posts.show')->with(['post' => $post,'comments' =>$comment->paginate(5),'keyword'=>$keyword]);
  
    }else{
      
      // 該当するpost_idを探す
      // $comment = Comment::where('post_id', $post->id);
      $comment = DB::table('comments')->where('post_id', $post->id)->paginate(5);
      
      return view('posts.show')->with(['post' => $post,'comments' =>$comment,'keyword'=>$keyword]);
      
    }
  }
     
  public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}   

public function update(Request $request,Post $post)
{
      // $post = new Post;
      $form = $request->all();
     
      if($request->file('image') == null){
        
        $image = null;
        
      }else{
      
      // 画像を変更する際に変更前の画像をS3から削除する  
      $s3_image = $post->s3_path;
      $s3_delete = Storage::disk('s3')->delete($s3_image); 
      
      //s3アップロード開始
      $image = $request->file('image');
      
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);
      
      // AmazonS3のパスを取得
      $post->s3_path = $path;
      
      }
      
      // タイトルを取得
      $post->title = $request->title;
      
      // ログインしているユーザーのUser_idを取得
      $post->user_id = Auth::id();
     
      $post->save();
      
      return redirect('/posts/' . $post->id);
}

public function delete(Post $post,Request $request)
{
    $s3_image = $post->s3_path;
    $s3_delete = Storage::disk('s3')->delete($s3_image);
    $post->delete();
    
    return redirect('/');
}


}
