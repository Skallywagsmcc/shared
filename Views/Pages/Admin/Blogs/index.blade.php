@extends("Layouts.main")

@section("tite")
    Admin Panel : Blogs
@endsection
@section("content")
    <div class="row">
        <div class="col-md-3">
{{--            Navbar goes here--}}
            <a href="/admin/blog/new">New Blog</a>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">Article title</div>
                <div class="col-md-3">Article Options</div>
            </div>
            @foreach($articles as $article)
                <div class="col-md-6">{{$article->title}}</div>
                <div class="col-md-3">Edit</div>
                <div class="col-md-3">Delete</div>
                @endforeach
        </div>
    </div>

@endsection