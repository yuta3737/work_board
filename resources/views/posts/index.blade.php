<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Board</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Board Name</h1>
        <div class='posts'>
          @section('content')
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>                    
                      @if ($post->image_path)
                      <!-- 画像を表示 -->
                      <img src="{{ $post->image_path }}" style="width:100px;">
                      <!--<img src="https://example.s3-ap-northeast-1.amazonaws.com/{{ $post->image_path }}" >-->
                      @endif

                </div>
            @endforeach
          @endsection  
               
        </div>
        <a href='/posts/create'>create</a>
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
    </body>
</html>




