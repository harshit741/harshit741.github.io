@foreach($posts as $post)
<div class="post-preview">
    <a href="/posts/{{$post->id}}">
        <h2 class="post-title">
            {{$post->title}}
        </h2>
        <h3 class="post-preview">
            {!!Str::words($post->body, 15, ' ....')!!}
        </h3>
    </a>
    @if ($post->anonymous != 'anonymous')
        <p class="post-meta">Posted by
        <a href="/author/{{$post->author}}">{{ $post->author }}</a>
    @else
        <p class="post-meta">Posted as
        <a>Anonymous</a>
    @endif
    &nbsp;at {{$post->created_at}}
                &nbsp; &nbsp;
                Category: 
                <a href="/category/{{$post->category}}">{{$post->category}}</a>
    </p>
</div>
<hr>
@endforeach