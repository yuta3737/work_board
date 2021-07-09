<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Board</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
   <body>
    <h1 class="title">編集画面</h1>
    <div class="content">
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class='content__title'>
                <h2>title</h2>
                <input type='text' name='title' value="{{ $post->title }}">
            </div>
            <div class='content__body'>
                <!-- アップロードフォームの作成 -->
                <input type="file" name="image">
            </div>
            <input type="submit" value="保存">
        </form>
        
        <div class="back">[<a href="/">back</a>]</div>
    </div>
</body>
</html>




