@extends("Layouts.main")

@section("title")
    Admin Panel New Article
    @endsection()

@section("content")
{{$message}}
@isset($values)
@foreach($values as $value)
    Missing {{$value}}
    @endforeach
@endisset
<div class="head">Create a new Article</div>
    <form action="/admin/blog/new" method="post">
        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" class="form-control" name="title" value="{{$article->title}}">
        </div>
        <div class="form-group">
            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$article->content}}</textarea>
        </div>
        <div class="form-group text-right">
            <button class="btn btn-primary">Create Article</button>
        </div>
    </form>
@endsection