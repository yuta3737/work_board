<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Board</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <h1>title</h1>
        

        
        <div class='post'>
            <h2 class='title'>{{ $post->title }}</h2>
        </div>
        

            <div class='comments'>
            
           
            
            @foreach ($comments as $comment)
            @if($comment->post_id == $post->id)
                <div class='comment'>
                
                    <h2 class='title'>{{ $comment->body }}</h2>
                    
                    
                </div>
             @endif
            @endforeach
          <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button> 
            </form>  
            
        </div>
            
        </div>
        
        
        
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>