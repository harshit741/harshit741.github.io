@extends('layout.main')
@section('title','Create Post - BlogInLaravel')

@section('content')
    <!-- Page Header -->
    <header class="container">
        <h1 class="createPost">Create Post</h1>
        <hr>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-10 mx-auto">
                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
            
            
                    <div class="control-group mb-3">
                        <div class="form-group floating-label-form-group controls">
                            <label>Post Body</label>
                            <textarea rows="15" class="form-control" name="body" placeholder="Post Body"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div class="custom-file mb-4">
                        <input type="file" class="custom-file-input" id="header_image" name="header_image">
                        <label class="custom-file-label" for="header_image">Header Image</label>
                    </div>
                    <div class="">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select id="category" class="custom-select custom-select-lg mb-4 " >
                                        <option selected>Select Category</option>
                                        @php($cats = App\Posts::pluck('category'))
                                        @php($cats = $cats->unique())
                                            @if(count($cats)> 0)
                                                @foreach($cats as $cat)
                                                    <option value="{{$cat}}">{{$cat}}</option>
                                                 @endforeach
                                            @endif
                                    </select>  
                                </div>
                                <input type="text" class="form-control form-control-lg" name="category" placeholder="Or Add Your Own">
                            </div>
                        <div class="custom-control custom-switch mb-4 custom-control-inline">
                            <input type="checkbox" class="custom-control-input " id="anonymous" value="anonymous" name="anonymous">
                            <label class="custom-control-label" for="anonymous">Post Anonymously</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create Post" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js" ></script>
    <script>
        CKEDITOR.replace( 'body' );
        window.addEventListener('DOMContentLoaded', function() {
        (function($) {
            //CK Editor
            $(document).ready(function(){
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
                //Adding category via text or dropdown
                $("#category").on('change', function(){
                    if(this.value == "Select Category"){
                        $('[name="category"]').val("");
                        $('[name="category"]').attr('readonly', false);
                    }else{

                        $('[name="category"]').val(this.value);
                        $('[name="category"]').attr('readonly', true);
                    }
                });
            });
        })(jQuery);
    });
    </script>

@endsection