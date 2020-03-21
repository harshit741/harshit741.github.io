@extends('layout.main')
@section('title','Post - BlogInLaravel')
@section('content')

    <!--  Header Image-->
        @if ($posts->header_image == 'noimage.png')
            <header class="masthead" style="background-image:url({{asset('img/noimage.png')}})">
        @else
            <header class="masthead" style="background-image:url({{asset('storage/post_header/'.$posts->header_image)}})">
        @endif
                <div class="overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-10 mx-auto">
                                <div class="site-heading">
                                    <h2>{{$posts->title}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>

    <!-- Post Content -->
        
        <article>
            <div class="container">
                    <a href="/posts" class="btn btn-info "><i class="fas fa-chevron-left"></i> Go Back</a>

                <div class="row">
                            <div class="col-lg-8 col-md-10 mx-auto">
                                <div class="post-preview">
                                        <h2 class="post-title">
                                            {{$posts->title}}
                                        </h2>
                                        <p class="post-subtitle">
                                        {!! $posts->body !!}
                                        </p>
                                    </a>
                                    @if ($posts->anonymous != 'anonymous')
                                    <p class="post-meta">Posted by
                                        <a href="/author/{{$posts->author}}">{{$posts->author}}</a>
                                    @else
                                    <p class="post-meta">Posted as
                                        <a>Anonymous</a>
                                    @endif
                                       at {{$posts->created_at}}</p>
                                       <p class="post-meta">Category: 
                                       <a href="/category/{{$posts->category}}">{{$posts->category}}</a></p>
                                </div>
                            </div>
                </div>
            </div>
        </article>
@endsection