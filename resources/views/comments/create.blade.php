<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/comments/{{$comment}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                
                <input type="text" name="body" placeholder="本文"/>
                <input type="hidden" value="{{$post->id}}" name="post_id">

                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            <!-- アップロードフォームの作成 -->
            <input type="file" name="image">
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>