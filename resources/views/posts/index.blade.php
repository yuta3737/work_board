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
        @section('content')
        
          
            <div class="container">
            
            <form action="/" method="GET" class="search">
                <p><input type="text" name="keyword" value="{{$keyword}}">
                <input type="submit" value="検索"></p>
            </form>    
            
            <div class="button03">
                <a href='/posts/create'>新しく投稿する</a>   
            </div>    

            <div class='posts'>
            @foreach ($posts as $post)
                <a href="/posts/{{ $post->id }}">
                <div class='post'>
                      @if ($post->image_path)
                      <!-- 画像を表示 -->
                        <div class="image">
                            <img src="{{ $post->image_path }}"> 
                        </div>                    
                      @endif
                     <h2 class='title'>{{ $post->title }}</h2>       
                </div>
                </a>
            @endforeach
            </div> 
            
            <div class='paginate'>
            {{ $posts->appends(request()->input())->links() }}
            </div>            
            </div>
            <footer>
                <p>©2021 Yuta Sasaki</p>
            </footer> 
          @endsection  
          
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




