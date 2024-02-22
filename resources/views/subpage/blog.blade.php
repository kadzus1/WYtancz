@extends('layouts.header')

@section('content')

<section id="features">
    <div class="container">
        <header>
            <h2><strong style="color: #7b0000;">BLOG</strong></h2>
        </header>

        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="media mb-3">
                    @if ($post->image)
                    <div class="relative" style="width:350px; height:350px">
                        <img src="{{ Storage::url($post->image) }}" alt="Obraz" class="object-cover w-full h-full rounded-lg"> 
                        <div class="absolute bottom-0 left-0 bg-white p-2 w-full text-center">
                            <p class="font-bold">{{ $post->title }}</p>
                            <p class="text-xs text-gray-600">{{ $post->content }}</p>
                            <div class="flex justify-between mt-2">
                                <p class="text-xs text-gray-600">{{ $post->user->name }}, {{ $post->created_at->format('d.m.Y H:i') }} </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        @if ($posts->isEmpty())
            <p>Brak postów do wyświetlenia.</p>
        @endif

        @auth
        <div class="flex items-center justify-center h-12 dark:bg-gray-800 my-8 ">
            <div class="shadow-md rounded-lg dark:bg-gray-700">
                <a href="{{ route('create-post') }}" class="flex items-center bg-transparent hover:bg-red-800 text-red-800 font-semibold hover:text-white py-3 px-4 border border-red-800 hover:border-transparent rounded">
                    Dodaj post
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 text-red-800 ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
            </div>
        </div>
        @endauth
    </div>
</section>


@endsection