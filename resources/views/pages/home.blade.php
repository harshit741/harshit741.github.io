@extends('layout.main')
@section('title','Home - BlogInLaravel')
@section('content')
    
    <!-- Page Header -->
    <header class="masthead" style="background-image:url({{asset('img/home-bg.jpg')}})">
        <div class="overlay"></div>
        <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
                <h2>Blog In Laravel | A PHP Framework</h2>
                <span class="subheading">A Blog Theme by Start Bootstrap</span>
            </div>
            </div>
        </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            
        <div class="col-lg-8 col-md-10 mx-auto">
            @if(count($posts) > 0)
                @include('layout.post')
            @else
                <h2>No Posts Found</h2>
            @endif
            <!-- Pager -->
            <div class="clearfix">
            <a class="btn btn-primary float-right" href="/posts">Older Posts &rarr;</a>
            </div>
        </div>
        </div>
    </div>
    <hr>

@endsection
