@extends("Layouts.main")

@section("title")
    Charters : {{$chaters->title}}
@endsection


@section("content")

    <div class="container">
        <div class="row">
{{--                Sidebar--}}
                <div class="col-sm-12 col-md-3">
                    <div class="col-sm-12 text-center">
                        <div class="col-sm-12 head">Our Charters</div>
                        @foreach($sidebar as $menu)
                            @if($menu->id == $charter->id)
                                <div class="py-1 text-center" >
                                    <a href="{{$url->make("charters.view",["slug"=>$menu->slug])}}" >{{$menu->title}}</a>
                                </div>
                            @else
                                <div class=" py-1 text-center">
                                    <a href="{{$url->make("charters.view",["slug"=>$menu->slug])}}">{{$menu->title}}</a>
                                </div>
                                @endif

                            @endforeach
                    </div>
                </div>
                <div class=" col-sm-12 col-md-9">
                    <div class="col-sm-12 head">Welcome to {{$charter->title}} Charter Page </div>
                    <div class="col-sm-12">{{$charter->content}}</div>
                    <div class="text-right">{{$likes->likes($charter->uuid)->count()}} People Like this {{$likes->Links($charter->uuid)}}This charter information was last updated on : {{date("d/m/Y - H:i:s a",strtotime($charter->updated_at))}}</div>
                </div>
        </div>
    </div>
@endsection