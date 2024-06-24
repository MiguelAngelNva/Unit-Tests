@foreach ($events as $event)
    <div class="event">
        <h6>{{$event->name}}</h6>
        <h6>{{$event->date}}</h6>
        <h6>{{$event->time}}</h6>
        <h6>{{$event->location}}</h6>
    </div>
@endforeach