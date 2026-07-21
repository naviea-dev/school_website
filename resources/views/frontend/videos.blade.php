@extends('layouts.app')

@section('title', 'ভিডিও গ্যালারী')

@section('content')
<style>
    .gallery-container {
        padding: 60px 0;
        background-color: #f8f9fa;
    }

    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 40px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 4px;
        background: #198754;
        border-radius: 2px;
    }

    .gallery-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 4 / 3;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        cursor: pointer;
        border: none;
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 70%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-card:hover .gallery-img {
        transform: scale(1.1);
    }

    .gallery-info h6 {
        color: #fff;
        margin: 0;
        font-weight: 600;
        font-family: 'Hind Siliguri', sans-serif;
        transform: translateY(10px);
        transition: transform 0.4s ease;
    }

    .gallery-card:hover .gallery-info h6 {
        transform: translateY(0);
    }

    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.7);
        color: white;
        font-size: 3rem;
        opacity: 0.85;
        transition: all 0.4s ease;
    }

    .gallery-card:hover .play-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
</style>

<main id="main" class="gallery-container">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="section-title fw-bold">ভিডিও গ্যালারী</h2>
            </div>
        </div>

        <div class="row g-3">
            @forelse ($videos as $video)
                @php
                    $coverImage = $video->cover
                        ? $video->cover
                        : asset('assets/front/images/defaultlogo.png');
                @endphp

                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.youtube.com/watch?v={{ $video->video_ref }}"
                        class="glightbox" data-type="video" data-gallery="union-videos" data-title="{{ $video->video_title }}">
                        <div class="card gallery-card shadow-sm">
                            <img src="{{ $coverImage }}" alt="{{ $video->video_title }}" class="gallery-img" loading="lazy">

                            <ion-icon name="play-circle-outline" class="play-icon"></ion-icon>

                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h6>{{ $video->video_title }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 border shadow-sm">
                        <ion-icon name="videocam-outline" style="font-size: 4rem; color: #dee2e6;"></ion-icon>
                        <h4 class="mt-3 text-muted">গ্যালারীতে কোনো ভিডিও পাওয়া যায়নি</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection
