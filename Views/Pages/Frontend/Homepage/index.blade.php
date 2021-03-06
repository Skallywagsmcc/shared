@extends("Layouts.main")
@section("title")
    (Home)
@endsection
@section("content")
{{--    {{date("M d Y H:i:s")}}--}}
{{--  <p id="demo"></p>--}}
{{--  <script>--}}
{{--        // Set the date we're counting down to--}}

{{--        var countDownDate = new Date("{{date(date("H:i:s"),strtotime("+1 hour"))}}").getTime();--}}

{{--        // Update the count down every 1 second--}}
{{--        var x = setInterval(function() {--}}

{{--            // Get today's date and time--}}
{{--            var now = new Date().getTime();--}}

{{--            // Find the distance between now and the count down date--}}
{{--            var distance = countDownDate - now;--}}

{{--            // Time calculations for days, hours, minutes and seconds--}}
{{--            var days = Math.floor(distance / (1000 * 60 * 60 * 24));--}}
{{--            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (000 * 60 * 60));--}}
{{--            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));--}}
{{--            var seconds = Math.floor((distance % (1000 * 60)) / 1000);--}}

{{--            // Output the result in an element with id="demo"--}}
{{--            document.getElementById("demo").innerHTML = days + "d " + hours + "h "--}}
{{--                + minutes + "m " + seconds + "s ";--}}

{{--            // If the count down is over, write some text--}}
{{--            if (distance < 0) {--}}
{{--                clearInterval(x);--}}
{{--                document.getElementById("demo").innerHTML = "EXPIRED";--}}
{{--            }--}}
{{--        }, 1000);--}}
{{--    </script>--}}

    <div class="container">
        <div class="row my-3">
            <div class="col-sm-12 head">Updates</div>
            <div class="col-sm-12">18/06/2021 : We are currently working on the layout and other small improvements to
                the frontend of the site
            </div>
            <div class="col-sm-12">19/06/2021 : Fixed Login Box Remember Me Session, Added Events Lisiting to the homepage
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-12 head">Beta Notice</div>
            <div class="col-sm-12">
                Welcome: although this site is operational, the site is in Beta which means some things may break and
                some things may change all change and code can be found <a
                        href="http://github.com/skallywagsmcc">Here</a>
                <hr>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row event my-2 text-center py-2 px-0">
            @if($events->count() == 0)
                <div class="col-sm-12">No Upcoming events</div>
            @else
                <div class="col-sm-12 col-md-2">Next Event : </div>
                <div class="col-sm-12 col-md-6">
                    @foreach($events  as $event)
                        <a href="{{$url->make("events.view",['slug'=>$event->slug])}}">{{$event->title}}</a>

                    @endforeach
                </div>
                <div class="col-sm-12 col-md-3">
                    @foreach($events as $event)
                        @if(date("d/m/Y",strtotime($event->start)) == date("d/m/Y"))
                            {{--                            Detect start time--}}
                            @if(date("H:i:s",strtotime("+1 Hour")) < date("H:i:s",strtotime($event->start)))
                                Event today at {{date("H:i:s",strtotime($event->start))}}
                                {{--                        Detect end time--}}
                                Event start at : {{date("H:i:s",strtotime($event->start))}}
                                @elseif(date("H:i:s",strtotime("+1 Hour")) > date("H:i:s",strtotime($event->end)))
                                Event Ended
                            @else
                               Event starts on {{date("d/m/Y",strtotime($event->start))}}
                                @endif
                        @else
                            Event starts on {{date("d/m/Y",strtotime($event->start))}}
                            @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 head pl-3 mb-1">Welcome to Skallywags</div>
            <div class="col-sm-12">
                <iframe class="p-0 text-right" width="100%" height="315"
                        src="https://www.youtube.com/embed/psYopokyg9U" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-3 ">
            <div class="col-sm-12 head">Featured Images</div>
            @if($featured->count() >= 1)
                @foreach($featured as $image)
                    <div class="col-sm-12 col-md-4 my-2">
                        <div class="col-sm-12">
                            <img class="border border-primary" src="/img/uploads/{{$image->Image->image_name}}"
                                 width="250"
                                 height="250" alt=""/>
                        </div>
                        <div class="col-sm-12 text-sm-center text-right">
                            <a href="{{$url->make("profile.gallery.home",["username"=>$image->Image->user->username])}}">{{$image->Image->user->username}}</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-sm-12">No Featured images added</div>
            @endif
        </div>
    </div>
    <div class="container my-3">
        <div class="row my-sm-2">
            <div class="col-sm-12 col-md-8 px-0 pr-md-2">
                <div class="info">
                    <div class="col-sm-12 head">Latest Articles</div>
                    @if($pages->count() >= 1)
                        @foreach($pages as $page)
                            <div class="col-sm-12 ">
                                <a href="{{$url->make("articles.view",["slug"=>$page->slug])}}">{{$page->title}}</a>
                            </div>

                        @endforeach
                        <div class="col-sm-12 px-0 text-center text-md-right"><a href="{{$url->make("articles.home")}}">View More articles</a></div>
                    @else
                        <div class="col-sm-12 text-center px-0">No Articles Found</div>
                    @endif

                </div>

            </div>
            <div class="col-sm-12 col-md-4  px-0 pl-md-2 ">
                <div class="info">
                    <div class="col-sm-12 head">Newest Club Member</div>
                    @if($member->count() >= 1)
                        <img src="/img/uploads/{{$member->first()->User->Profile->image->image_name}}" height="200px"
                             width="100%" alt="{{$member->first()->User->username}} Profile Image" class="my-1">
                        <div class="col-sm-12 text-right"><a href="{{$url->make("members.home")}}">All members</a></div>
                    @else
                        <div class="col-sm-12 text-center pr-md-0 px-0">No Members found</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection