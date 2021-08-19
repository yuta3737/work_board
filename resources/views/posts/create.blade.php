<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Board</title>
    </head>
    
    <body>
        
        <h1>Board Name</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
    
                <input type="text" name="title" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p>YouTubeを表示する</p>
                <input type="text" name="youtube_url" placeholder="YouTubeのurlを入力" style="width:300px" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            <!-- アップロードフォームの作成 -->
            <input type="file" name="image">
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>


