@extends('layouts.app')

@section('title', 'ফটো গ্যালারী - ফরিদপুর পৌরসভা')

@section('content')
<style>
    /* Gallery Section Styling */
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

    /* Modern Gallery Item */
    .gallery-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 4 / 3; /* Keeps all gallery items uniform */
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

    /* Hover Overlay */
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

    .zoom-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.5);
        color: white;
        font-size: 2.5rem;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .gallery-card:hover .zoom-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
</style>

<main id="main" class="gallery-container">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="section-title fw-bold">ফটো গ্যালারী</h2>
                <p class="text-muted">ইউনিয়ন পরিষদের বিভিন্ন কার্যক্রম ও উন্নয়নমূলক প্রকল্পের স্থিরচিত্র।</p>
            </div>
        </div>

        <div class="row g-3">
            @forelse ($photos as $photo)
                @php
                    $coverImage = $photo->image
                        ? $photo->image
                        : asset('assets/front/images/defaultlogo.png');
                @endphp
                
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ $coverImage }}" class="glightbox" data-gallery="union-gallery" data-title="{{ $photo->name }}">
                        <div class="card gallery-card shadow-sm">
                            <img src="{{ $coverImage }}" alt="{{ $photo->name }}" class="gallery-img" loading="lazy">
                            
                            <div class="zoom-icon">
                                <ion-icon name="expand-outline"></ion-icon>
                            </div>
                            
                            <div class="gallery-overlay">
                                <div class="gallery-info">
                                    <h6>{{ $photo->name }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-4 border shadow-sm">
                        <ion-icon name="images-outline" style="font-size: 4rem; color: #dee2e6;"></ion-icon>
                        <h4 class="mt-3 text-muted">গ্যালারীতে কোনো ছবি পাওয়া যায়নি</h4>
                    </div>
                </div>
            @endforelse
        </div>
        
        @if(method_exists($photos, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $photos->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</main>
@endsection