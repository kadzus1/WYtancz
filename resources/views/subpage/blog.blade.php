@extends('layouts.header')

@section('content')

<section id="features">
	<div class="container">
		<header>
			<h2><strong style="color: #7b0000;">BLOG</strong></h2>
		</header>

        @foreach ($posts as $post)
        <div class="media mb-3">
            @if ($post->image_path)
            <div class="relative">
                <img src="{{ asset('storage/' . $post->image_path) }}" class="object-cover w-48 h-48 rounded-lg" alt="{{ $post->title }}">
                <div class="absolute bottom-2 left-0 bg-white px-2 py-1 rounded-lg shadow-md">
                    <p class="text-xs text-gray-600">{{ $post->user->name }}</p>
                    <p class="text-xs text-gray-600">{{ $post->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
            @endif
            <div class="media-body ml-3">
                <h5 class="mt-0">{{ $post->title }}</h5>
                <p>{{ $post->content }}</p>
            </div>
        </div>
        @endforeach

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
