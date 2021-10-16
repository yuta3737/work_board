<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Board</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
        
        
    </head>
    <body>
    <div class="container">
        <div class='show_post'>
            
            <div class='first_row'>
            <div class="button03 col-md-4">    
            <a href="/posts/{{ $post->id }}/edit">編集する</a>
            </div>  
            
            <div class="button03 col-md-4">    
             <a href="/">戻る</a>
            </div>
                    
            
            </div>
            
            <div class='second_row'>
                 @if ($post->image_path == null)
                <!-- 画像を表示 -->
                <div class="image">
                    <img src="{{ asset('images/02.png') }}">                             
                </div>    
                @else($post->image_path)
                <!-- 画像を表示 -->
                <div class="image">
                    <img src="{{ $post->image_path }}"> 
                </div>    
                @endif
                <h2 class='title'>{{ $post->title }}</h2>       
            </div>            
          
        </div>

            <div class="youtube_content col-md-4">
            <div class="youtube_body">
                <div class="youtube_head">
                    <h2>関連動画</h2>
                </div>    
                @foreach ($snippets as $snippet)
                    <div class="youtube_videos">
                        <a href="https://youtu.be/{{ $snippet->id->videoId }}">
                        <div class="youtube_link">    
                            <div class="youtube_img">
                                <img src="{{ $snippet->snippet->thumbnails->default->url}}"> 
                            </div> 
                            
                            <div class="youtube_title">
                                {{ $snippet->snippet->title }}
                            </div>
                        </div> 
                        </a>
                    </div>
                    
                @endforeach
            </div>    
            </div>
              
    
        <form name="faceForm" id="move"　action="/comments/{{$post->id}}" class="comment_form col-md-8" method="POST" enctype="multipart/form-data">
            @csrf
                <input  name="face" type="hidden" name="reply" placeholder="返信したい投稿のIDを記入"/>
                <div id="reply_comment">
                    
                </div>                
                
                
                <textarea class="col-md-12" type="text" name="body" placeholder="コメントを書く"></textarea>
                <p class="title__error" style="color:red;text-align:left">{{ $errors->first('body') }}</p>
                <div class="comment_create">
                <p class="col-md-6">YouTubeを表示する</p>

                <input class="col-md-6" type="text" name="youtube_url" placeholder="YouTubeのurlを入力" style="width:300px" value="{{ old('post.title') }}"/>
                </div>
                
                <div class="comment_create">
                <p class="col-md-4">画像を表示する</p>
                <!-- アップロードフォームの作成 -->
                <input class="comment_save col-md-8" type="file" name="image">
                </div>
                <input class="btn btn-primary" type="submit" value="コメントする"/>
                
        </form>
        

        
        
        
        <div class="show_top"> 
        <div class="button03 col-md-6">    
        <a href='/comments/{{ $post->id }}/create'>コメントする</a>
        </div> 
        <form action="/posts/{{ $post->id }}" method="GET" class="show_form col-md-6">
            
            <!--<div class="col-md-4">-->
            <!--    <p>コメントを検索する</p>-->
            <!--</div>     -->
            <div class="col-md-6">
                <input type="text" name="keyword" value="{{$keyword}}">
                <input type="submit" value="検索">
            </div>              
        </form>        
        </div> 
        
            <div class='comments'>
            
            @foreach ($comments as $comment)

                <div class='comment col-md-8' id='comment_{{$comment->id}}'>
                    
                      <div class='comment_id'>
                          <a href="#comment_{{$comment->reply}}"> >>{{$comment->reply}}</a>
                          <p>ID : {{ $comment->id }}</p>                         
                      </div>
                      
                      <div class='comment_picture'>
                      @if ($comment->youtube_path == null )
                      <!--何もなし-->
                      @else
                      <div class='comment_iframe col-md-6'>
                      <iframe src="https://www.youtube.com/embed/{{ $comment->youtube_path }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                      </iframe>
                      </div>  
                      @endif              
                       
                      @if ($comment->image_path)
                      <!-- 画像を表示 -->
                      <div class='comment_image col-md-6'>
                      <img src="{{ $comment->image_path }}">
                      </div>  
                      @endif    
                      </div> 
        
                      <p class='body'>{{ $comment->body }}</p>
                      
                    <div class="comment_command">  
                    <div class="button02">    
                    
                    <a href="/comments/{{ $comment->id }}/edit">編集する</a>
                    </div>   
                    
                    <form class="flexbox" action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button4">消去する</button>
                    </form> 
                    
                    <a href="#move"><button class="btn2 button4" value="{{$comment->id}}">返信する</button></a>
                    </a>
                    </div>  
                </div>
                
                <div class="comment_reply">
                    <form action="/comments/{{$comment->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class='content__title'>
                            <h2>title</h2>
                            <input type='text' name='body' value="{{ $comment->body }}">
                            <p>YouTubeを表示する</p>
                            <input type='text' name='youtube_url' value="{{ $comment->youtube_url }}" style="width:300px">                
                        </div>
                        
                        <div class='content__image'>
                            <!-- アップロードフォームの作成 -->
                            <input type="file" name="image">
                        </div>
                        <input type="submit" value="保存" >
                    </form>                    
                </div>
                

            @endforeach
            
            </div>
            
        {{ $comments->appends(request()->input())->links() }}
            
 
            <div class="show_end"> 
            <div class="button03 col-md-4">    
             <a href="/">戻る</a>
            </div>
            
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline" class="">
            @csrf
            @method('DELETE')
            <button type="submit" class="button1">delete</button> 
            </form>              
            </div>
        
        </div>
        
    <script type="module" text="javascript" src="{{ asset('js/show.js') }}"></script>
    </body>
</html>