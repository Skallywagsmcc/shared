@extends("Layouts.main")

@section("title")
    Admin panel : New Event
    @endsection


@section("content")

    <div class="container">
        <form action="{{$url->make("admin.events.store")}}" method="post">
            {{csrf()}}
            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" class="form-control" name="title" placeholder="Event Title">
            </div>

            <div class="form-group">
                <label for="content">About the event</label>
                <textarea class="form-control" rows="10" placeholder="About the event" name="content"></textarea>
            </div>

            <div class="form-group">
                <label for="start">Event Start time</label>
                <input type="datetime-local" class="form-control" name="start">
            </div>


            <div class="form-group">
                <label for="end">Event end time</label>
                <input type="datetime-local" class="form-control" name="end">
            </div>

            <div class="col-sm-12 head">Location Details</div>

            <div class="form-group">
                <label for="name">Building Name or number</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street name</label>
                    <input type="text" name="street" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="county">County</label>
                    <input type="text" name="county" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="postcode">Postcode</label>
                    <input type="text" name="postcode" class="form-control">
                </div>
            </div>

            <button class="btn btn-primary btn-block">Creat Event</button>




        </form>
    </div>
    @endsection()