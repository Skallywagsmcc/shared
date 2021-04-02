@extends("Layouts.main")
@section("title")
    Skallywagsmcc Articles
@endsection

@section("content")
    @if($count == 1)
        {{ redirect($url->make("pages.view",["category"=>$category->slug,"slug"=>$articles->first()->slug]))}}
    @elseif($count > 1)
    @foreach($articles as $article)
        <div class="row">
            <div class="col-md-12 head">
                {{$article->title}}
            </div>
            <div class="col-md-12">
                {!! nl2br($article->content) !!}
                <hr>
            </div>
            <div class="col-md-6">Date created {{$article->created_at}}</div>
            <div class="col-md-6 text-right"><a href="{{$url->make("pages.view",["category"=>$article->category->slug,"slug"=>$article->slug])}}">View Article</a></div>
        </div>
        {!! $links !!}
    @endforeach
    @else
        No articles found;
    @endif

    <form action="{{$url->make("pages.search",["category"=>$article->category->slug])}}" method="get">
        <input type="text" name="keyword">
        <button>save</button>
    </form>
@endsection