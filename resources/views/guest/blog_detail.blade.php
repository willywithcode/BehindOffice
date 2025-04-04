@extends('layouts.guest')

@section('styles')
<style>
    .fade-zoom-in {
        opacity: 0;
        transform: scale(0.95);
        animation: fadeZoomIn 0.8s ease-out forwards;
    }

    @keyframes fadeZoomIn {
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .slide-up {
        opacity: 0;
        transform: translateY(40px);
        animation: slideUp 0.8s ease-out forwards;
    }

    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-delay-1 { animation-delay: 0.2s; }
    .fade-delay-2 { animation-delay: 0.4s; }
    .fade-delay-3 { animation-delay: 0.6s; }

    .group:hover .hover-zoom {
        transform: scale(1.05);
    }

    .hover-zoom {
        transition: transform 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="relative w-screen h-[400px] mb-16">
    <img src="{{ asset('assets/image3.png') }}" alt="Banner" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-white text-5xl font-bold fade-zoom-in">Bài viết</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Sidebar -->
        <div class="hidden lg:block slide-up">
            <div class="space-y-6">
                <div class="text-center border-b pb-4">
                    <div class="text-3xl font-bold text-gray-900">966</div>
                    <div class="text-gray-500 text-sm">Lượt xem</div>
                </div>
                <div class="flex flex-col items-center space-y-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank">
                        <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook" width="48" height="48">
                    </a>
                    <a href="https://zalo.me/zalo-share?u={{ urlencode(request()->url()) }}" target="_blank">
                        <img src="{{ asset('assets/zalo.png') }}" alt="Zalo" width="48" height="48">
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2 fade-zoom-in">
            <h1 class="text-3xl font-bold mb-6">{{ $post->title }}</h1>
            <div class="space-y-6 text-justify leading-relaxed text-gray-800">
                {!! $post->content !!}
            </div>
        </div>
    </div>

    @if($relatedPosts->count())
        <div class="mt-20">
            <h2 class="text-2xl font-semibold mb-6 slide-up">Bài viết liên quan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($relatedPosts as $index => $relatedPost)
                    <a href="{{ route('blog.detail', ['slug' => $relatedPost->slug]) }}"
                       class="block group bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all duration-300 fade-zoom-in fade-delay-{{ $index % 3 + 1 }}">
                        <img src="{{ asset('assets/image1.png') }}"
                             class="w-full h-[200px] object-cover mb-3 hover-zoom">
                        <div class="px-4 pb-4">
                            <h3 class="text-md font-semibold group-hover:text-blue-600">{{ $relatedPost->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $relatedPost->display_excerpt }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
