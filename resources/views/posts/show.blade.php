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
    @section('content')
    <div class="container">
        <div class='show_post'>
            <!--------投稿編集------------>
            <div class='first_row'>
                <div class="button03">
                    <a href="/posts/{{ $post->id }}/edit">投稿編集</a>
                </div>
            </div>
            <!--------投稿---------->
            <div class='second_row'>
                @if ($post->image_path == null)
                <!--画像を表示 -->
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
            <!-------->
        </div>
        <!---------YouTube関連動画表示----------->
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

        <!------------コメント投稿-------------->
        <form name="faceForm" id="move" action="../comments" class="comment_form col-md-8" method="POST" enctype="multipart/form-data">
            @csrf
            <!--post_id取得-->
            <input type="hidden" value="{{$post->id}}" name="post_id">
            <!--返信するIDの取得-->
            <input name="face" type="hidden" name="reply" placeholder="返信したい投稿のIDを記入" />
            <!--返信するIDの取得を表示する-->
            <div id="reply_comment">

            </div>
            <!-----コメント------->
            <textarea class="col-md-12" type="text" name="body" placeholder="コメントを書く"></textarea>
            <p class="title__error" style="color:red;text-align:left">{{ $errors->first('body') }}</p>
            
            <div class="comment_create">
                <p class="col-md-6">YouTubeを表示する</p>

                <input class="col-md-6" type="text" name="youtube_url" placeholder="YouTubeのurlを入力" style="width:300px" value="{{ old('post.title') }}" />
            </div>

            <div class="comment_create">
                <p class="col-md-4">画像を表示する</p>
                <!-- アップロードフォームの作成 -->
                <input class="comment_save col-md-8" type="file" name="image">
            </div>
            <input class="btn btn-primary" type="submit" value="コメントする" />

        </form>
        <!-------->




        <div class="show_top">
            <form action="/posts/{{ $post->id }}" method="GET" class="show_form col-md-6">
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

                    <button class="edit_btn button4" id='edit_btn'>編集する</button>
                    <button id='show_button'>編集する</button>

                    <form class="flexbox" action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button4">消去する</button>
                    </form>

                    <a href="#move"><button class="btn2 button4" value="{{$comment->id}}">返信する</button></a>
                    </a>
                </div>
            </div>
            <!-------------------------隠れている編集フォーム----------------------------------------->
            <!--<div id="switch">-->
            <form action="../comments/{{$comment->id}}" class="comment_form hideform col-md-8" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input name="face" type="hidden" name="reply" placeholder="返信したい投稿のIDを記入" />
                <div id="reply_comment">

                </div>


                <textarea class="col-md-12" type="text" name="body" placeholder="コメントを書く">{{ $comment->body }}</textarea>
                <p class="title__error" style="color:red;text-align:left">{{ $errors->first('body') }}</p>
                <div class="comment_create">
                    <p class="col-md-6">YouTubeを表示する</p>

                    <input class="col-md-6" value="{{ $comment->youtube_url }}"  type="text" name="youtube_url" placeholder="YouTubeのurlを入力" style="width:300px" />
                </div>

                <div class="comment_create">
                    <p class="col-md-4">画像(変更時のみ入力)</p>
                    <!-- アップロードフォームの作成 -->
                    <input class="comment_save col-md-8" value="{{ $comment->image_path }}" type="file" name="image">
                </div>
                <input class="btn btn-primary" type="submit" value="コメントする" />

            </form>
            
            <!--</div>-->
            <!-------------------------隠れている編集フォーム----------------------------------------->
            
            @endforeach

        </div>

        {{ $comments->appends(request()->input())->links() }}

        <!---------スマホサイズの時のみ YouTube関連動画表示----------->
        <div class="sp_youtube_content">
            <div class="youtube_body">
                <div class="youtube_head">
                    <h2>関連動画</h2>
                </div>
                @foreach ($snippets as $snippet)
                <div class="sp_youtube_videos">
                    <a href="https://youtu.be/{{ $snippet->id->videoId }}">
                        <div class="sp_youtube_link">
                            <div class="sp_youtube_title">
                                {{ $snippet->snippet->title }}
                            </div>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>


        <div class="show_end">
            <div class="button03 sp_show_end">
                <a href="/">戻る</a>
            </div>

            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="show_delete">
                @csrf
                @method('DELETE')
                <button type="submit" class="button1" onclick='return confirm("削除しますか？");'>投稿を消去する</button>
            </form>
        </div>

    </div>
    @endsection
    <!--------ヘッダー---------->
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script type="module" text="javascript" src="{{ asset('js/show.js') }}"></script>
</body>

</html>