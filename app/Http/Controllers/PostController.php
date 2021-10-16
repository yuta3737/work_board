<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_YouTube;

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
    
    




  
    
    
    public function store(PostRequest $request)
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
        
    const MAX_SNIPPETS_COUNT = 7;
    const DEFAULT_ORDER_TYPE = 'relevance';      
    
  public function show(Post $post,Comment $comment,Request $request)
  {
    $keyword = $request->keyword;
    
    if(!empty($keyword)){
      
      $comment = DB::table('comments')->where('post_id', $post->id)->where('body', 'LIKE', '%'.$keyword.'%')->paginate(10);
      
      return view('posts.show')->with(['post' => $post,'comments' =>$comment,'keyword'=>$keyword,'comment' =>$comment]);
  
    }else{
      
      // 該当するpost_idを探す
      // $comment = Comment::where('post_id', $post->id);
      $comment = DB::table('comments')->where('post_id', $post->id)->latest('created_at')->paginate(10);
      
        // Googleへの接続情報のインスタンスを作成と設定
        $client = new Google_Client();
        $key ='AIzaSyCPCFjrI7aEOlKResgpSJiROxyiuHTvO5Q';
        $client->setDeveloperKey($key);
        $searchWord = $post->title;
        // 接続情報のインスタンスを用いてYoutubeのデータへアクセス可能なインスタンスを生成
        $youtube = new Google_Service_YouTube($client);
        // dd($youtube);
        // 必要情報を引数に持たせ、listSearchで検索して動画一覧を取得
        $items = $youtube->search->listSearch('snippet', [
            // 'channelId'  => $channelId,
            'order'      => self::DEFAULT_ORDER_TYPE,
            'maxResults' => self::MAX_SNIPPETS_COUNT,
            'type'=> 'video',
            'q' => $searchWord,
            
        ]);
        
        // dd($items);
        // 連想配列だと扱いづらいのでcollection化して処理
        $snippets = collect($items->getItems())->all();      
      
      
      return view('posts.show')->with(['post' => $post,'comments' =>$comment,'keyword'=>$keyword,'snippets' => $snippets,'comment' =>$comment]);
      
    }
  }
     
  public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}   

public function update(PostRequest $request,Post $post)
{
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
      // YouTubeのurlを取得
      $Youtube_key = $request->youtube_url;
      $post->youtube_url = $request->youtube_url;
      // YouTubeの埋め込みiframeに必要な11文字のみ取得
      $post->youtube_path = substr($Youtube_key, -11);      
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
