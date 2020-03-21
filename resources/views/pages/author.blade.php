@extends('layout.main')
@section('title', $name)
@section('content')
<div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <header class="container">
            <h1 class="allPost">Posts By {{$name}}</h1>
            <hr>
        </header>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                @if ($post->anonymous != 'anonymous')
                    <div class="post-preview">
                        <a href="/posts/{{$post->id}}">
                            <h2 class="post-title">
                                {{$post->title}}
                            </h2>
                            <h3 class="post-preview">
                                {!! Str::words($post->body, 15, ' ....') !!}
                            </h3>
                        </a>
                        <p class="post-meta">
                            Category: <a href="/category/{{$post->category}}">{{$post->category}}</a>
                        </p>
                    </div>
                    <hr>
                @endif
            @endforeach
        @else
                <h2>1No Posts Found</h2>
        @endif
        <!-- Pager -->
        <div class="clearfix">
            {{$posts->links()}}
        </div>
    </div>
    </div>
</div>
<hr>

@endsection