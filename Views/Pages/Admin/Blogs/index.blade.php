@extends("Layouts.main")

@section("tite")
    Admin Panel : Blogs
@endsection
@section("content")
    @include("Includes.AdminNav");
    <div class="row">
        <div class="col-md-3">
{{--            Navbar goes here--}}
            <a href="{{$url->make("admin.articles.new")}}">New Page</a>
        </div>
        <div class="col-md-9">
            <div class="row text-center head">
                <div class="col-md-6">Article title</div>
                <div class="col-md-6">Article Options</div>
            </div>
            @foreach($articles as $article)
                <div class="row text-center  m-2 mx-md-0 p-2 article-row">
                    <div class="col-md-6">{{$article->title}}</div>
                    <div class="col-md-2"><a href="{{$url->make("articles.view",["category"=>$article->category->slug,"slug"=>$article->slug])}}" target="_new">View Article</a></div>
                    <div class="col-md-2"><a href="{{$url->make("admin.articles.edit",["slug"=>$article->slug,"id"=>base64_encode($article->id)])}}">Edit Article</a></div>
                    <div class="col-md-2"><a href="{{$url->make("admin.articles.delete",["id"=>base64_encode($article->id)])}}">Delete Article</a></div>
                </div>
                @endforeach


    </div>
    </div>

@endsection