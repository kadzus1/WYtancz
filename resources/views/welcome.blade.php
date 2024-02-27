@extends('layouts.header')

@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            Boolean, default: true,
            contentHeight: 500,
            locale: 'pl',
            events: <?php echo json_encode($events); ?>,
        });
        calendar.updateSize()
        calendar.render();
    });
</script>

<section id="features">

    <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="max-width: 1200px; max-height: 600px; margin: auto;">
        <ol class="carousel-indicators">
            @foreach($posts as $key => $post)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" @if($key == 0) class="active" @endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($posts as $key => $post)
                <div class="carousel-item @if($key == 0) active @endif">
                    <img src="{{ Storage::url($post->image) }}" class="d-block w-100" alt="{{ $post->title }}">
                    <div class="carousel-caption d-none d-md-block text-lg-center" style="top: 0; bottom: auto;">
                        <h5 style="font-size: 2rem;">{{ $post->title }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>




</section>

<div>
    <section>
        <div id='calendar'></div>
    </section>
</div><br><br>

@endsection
