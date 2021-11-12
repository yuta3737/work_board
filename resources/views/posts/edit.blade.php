<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Board</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="col-md-8 center">
            <div class="edit">
                <div class="create_header">
                    <h1 class="title">編集画面</h1>
                </div>



                <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="create_form">
                    @csrf
                    @method('PUT')
                    <div class="create_tit">
                        <div class="col-md-4">
                            <p>タイトル</p>
                        </div>
                        <div class="col-md-6">
                            <input type='text' name='title' value="{{ $post->title }}" class="create_input">
                            <p class="title__error" style="color:red;text-align:left">{{ $errors->first('title') }}</p>
                        </div>
                    </div>

                    <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                    <!-- アップロードフォームの作成 -->
                    <div class="create_file">
                        <div class="col-md-4">
                            <p>サムネイル</p>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="image" value="{{ $post->image_path }}">
                        </div>
                    </div>
                    <p class="create_rule">※タイトルは必ず入力する</p>
                    <div class="col-md-6 offset-md-4">
                        <input type="submit" value="保存" class="btn btn-primary" style="width:80px">
                    </div>
                    <div class="button03 margin"><a href="/">戻る</a></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>