<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Board</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    
    <body>
        <div class="container">
        <div class="col-md-8 center">  
        <div class="create">  
            <div class="create_header">
                <h1>新規作成</h1>
            </div>
        <form action="/posts" method="POST" enctype="multipart/form-data" class="create_form">
            @csrf
                <div class="create_tit">
                    <div class="col-md-4">
                    <p>タイトル</p>
                    </div>
                    <div class="col-md-6">
                    <input type="text" name="title" placeholder="" class="create_input"/> 
                    <p class="title__error" style="color:red;text-align:left">{{ $errors->first('title') }}</p>
                    </div>                    
                </div>
                <div class="create_youtube">
                    <div class="col-md-4">
                    <p>YouTubeを表示する</p>
                    </div>
                    <div class="col-md-6">
                    <input type="text" name="youtube_url" placeholder="YouTubeのurlを入力" class="create_input" value="{{ old('post.title') }}"/>
                    </div>
                </div>
                
            <!-- アップロードフォームの作成 -->
                <div class="create_file">
                    <div class="col-md-4">
                    <p>画像を表示する</p>
                    </div>
                    <div class="col-md-6">
                    <input type="file" name="image">
                    </div>  
                </div>
                <p class="create_rule">※画像,YouTube urlは入力しなくても良い</p>
                <div class="col-md-6 offset-md-4">
                    <input type="submit" value="保存" class="btn btn-primary" style="width:80px"/>
                </div>
                <div class="button03 margin_top"><a href="/">戻る</a></div>
        </form>
        
        
        </div>
        </div>
        </div>
    </body>
</html>


