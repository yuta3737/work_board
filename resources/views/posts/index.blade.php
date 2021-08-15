<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Board</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <header>
            <h1>Board 掲示板</h1>
        </header>
        
        <form action="/" method="GET">
            <p><input type="text" name="keyword" value="{{$keyword}}"></p>
            <p><input type="submit" value="検索"></p>
        </form>
        
        <div class='posts'>
          @section('content')
          <a href='/posts/create' class='create'>create</a>   
            @foreach ($posts as $post)
                <div class='post'>
                    
                    <h2 class='title'><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                    
                      @if ($post->image_path)
                      <!-- 画像を表示 -->
                      <img src="{{ $post->image_path }}">
                      
                      @endif
                </div>
            @endforeach
            
            <div class='paginate'>
            {{ $posts->appends(request()->input())->links() }}
            </div>            
            
            <footer>
                <p>©2021 Yuta Sasaki</p>
            </footer>              
          @endsection  
          
        </div>
        
          
        

        
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




