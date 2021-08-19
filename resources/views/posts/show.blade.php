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
    [<a href='/comments/{{ $post->id }}/create'>コメントする</a>]
        <div class='post'>
            <h2 class='title'>{{ $post->title }}</h2>
            @if ($post->youtube_path == null )
            <!--何もなし-->
            @else
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $post->youtube_path }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endif
            
            @if ($post->image_path)
            <!-- 画像を表示 -->
            <img src="{{ $post->image_path }}">
            @endif            
        </div>
        
        <form action="/posts/{{ $post->id }}" method="GET">
            <p>コメントを検索する</p>
            <p><input type="text" name="keyword" value="{{$keyword}}"></p>
            <p><input type="submit" value="検索"></p>
        </form>        

            <div class='comments'>
            
            @foreach ($comments as $comment)

                <div class='comment'>
                      @if ($comment->youtube_path == null )
                      <!--何もなし-->
                      @else
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $comment->youtube_path }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      @endif              
                      <h2 class='title'>{{ $comment->body }}</h2>
                      @if ($comment->image_path)
                      <!-- 画像を表示 -->
                      <img src="{{ $comment->image_path }}">
                      @endif
                      
                </div>      
                    <p class="edit">[<a href="/comments/{{ $comment->id }}/edit">edit</a>]</p>
                    <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">delete</button> 
            </form> 
            @endforeach
            </div>
            
            {{ $comments->appends(request()->input())->links() }}
            
          <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button> 
            </form>  
            
        
            
        </div>
        
        
        
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>