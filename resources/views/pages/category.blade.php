@extends('layout.main')
@section('title', $category)
@section('content')
<div class="container">
    <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <header class="container">
            <h1 class="allPost">Posts in {{$category}}</h1>
            <hr>
        </header>
        @if(count($posts) > 0)
        @foreach($posts as $post)
        <div class="post-preview">
            <a href="/posts/{{$post->id}}">
                <h2 class="post-title">
                    {{$post->title}}
                </h2>
                <h3 class="post-preview">
                    {!! Str::words($post->body, 15, '...') !!}
                </h3>
            </a>
            @if ($post->anonymous != 'anonymous')
            <p class="post-meta">Posted by
                <a href="/author/{{$post->author}}">{{ $post->author }}</a>&nbsp;at {{$post->created_at}}
            </p>
            @else
            <p class="post-meta">Posted as
                <a >Anonymous</a>&nbsp;at {{$post->created_at}}
            </p>
            @endif
           
        </div>
        <hr>
        @endforeach        @else
            <h2>No Posts Found</h2>
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