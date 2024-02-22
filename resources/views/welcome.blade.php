@extends('layouts.header')

@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
        <header>
            <h2><strong style="color: #7b0000;">NOWOŚCI!</strong></h2>
        </header>
        <div id="indicators-carousel" class="relative w-full" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        @foreach ($randomPosts as $post)
<div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $loop->first ? 'active' : '' }}">
   <div class="absolute bottom-0 left-0 bg-gray-800 p-2 w-full text-center">
        <p class="font-bold">{{ $post->title }}</p>
        <p class="text-xs text-gray-600">{{ $post->content }}</p>
    </div>
</div>
@endforeach


    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
        @foreach ($randomPosts as $key => $post)
        <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
        @endforeach
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-gray-800 group-hover:bg-white/50  group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-text-gray-800 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-gray-800  rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

    </div>
</section>

    </div>
</section>


<div>
    <section >
        <div id='calendar'></div>
    </section>
</div><br><br>


@endsection