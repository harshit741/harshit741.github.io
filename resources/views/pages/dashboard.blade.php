@extends('layout.main')
@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-10 col-md-offset-2">
            <header class="container">
                <h1 class="allPost">My Posts</h1>
                <hr>
            </header>
            @if(count($posts) > 0)
                @foreach($posts as $post)
                <div class="card">
                    <div class="card-header">
                      <a class="post-a" href="/posts/{{$post->id}}">{{$post->title}}</a>
                    <button data-toggle="modal" data-target="#delPost{{$post->id}}" data-targetid="{{$post->id}}" data-targetName="{{$post->title}}" class="btn btn-danger btn-sm float-right">Delete</button>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm float-right ">Edit</a>
                    </div>
                  </div>
                  <!-- The Modal -->
                  <div class="modal fade" id="delPost{{$post->id}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header bg-light">
                          <h4 class="modal-title">Delete Post&nbsp;</h4><span class="text-danger"><h3>{{$post->title}}</h3></span><h4> &nbsp ?</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            Are you sure to delete this post?
                          </div>
                          <div class="modal-footer">
                            <form action="{{route('posts.destroy',$post->id)}}" method="POST">@csrf
                              <input type="submit" class="btn btn-danger" value="Yes">
                              <input type="hidden" name="_method" value="DELETE">
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>        
                          </div>
                      </div>
                    </div>
                  </div>
                @endforeach
            @else
                <p>You have no posts</p>
            @endif
        </div>
    </div>
</div>
@endsection
