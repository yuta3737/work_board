<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/comments/{{$post_id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                
                <input type="text" name="body" placeholder="本文" value="{{ old('post.title') }}"/>
                <input type="hidden" name="post_id" value="12345">

                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            <!-- アップロードフォームの作成 -->
            <input type="file" name="image">
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>