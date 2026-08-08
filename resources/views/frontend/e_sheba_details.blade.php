@extends('layouts.app')

@section('title', $item->name . ' — ' . $commonData['school_name'])

@section('content')
<style>
    .article-container {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .article-header {
        border-bottom: 2px solid #f8f9fa;
        margin-bottom: 30px;
        padding-bottom: 20px;
    }
    .article-title {
        font-family: 'Hind Siliguri', sans-serif;
        font-weight: 700;
        color: #1a202c;
    }
    .article-body {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #3d4852;
        font-family: 'Hind Siliguri', sans-serif;
    }
    .e-sheba-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #e6f4ea;
        color: #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 20px;
    }
</style>

<main class="bg-light py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success">হোম</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="article-container shadow-sm p-4 p-md-5 text-center">
                    <div class="e-sheba-icon">
                        <ion-icon name="{{ $item->icon }}"></ion-icon>
                    </div>

                    <header class="article-header">
                        <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm mb-3">ই-সেবা</span>
                        <h1 class="article-title display-6 mb-0">{{ $item->name }}</h1>
                    </header>

                    <div class="article-body text-start">
                        {{ $item->description }}
                    </div>

                    @if (!empty($item->cta))
                    <div class="mt-4 pt-4 border-top">
                        @if (!empty($item->cta['url']))
                        <a href="{{ config('services.school_portal_url') }}" target="_blank" rel="noopener" class="btn btn-success rounded-pill px-4">
                            {{ $item->cta['label'] }}
                        </a>
                        @elseif (!empty($item->cta['route']))
                        <a href="{{ route($item->cta['route']) }}" class="btn btn-success rounded-pill px-4">
                            {{ $item->cta['label'] }}
                        </a>
                        @endif
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="/" class="btn btn-outline-success rounded-pill px-4">
                            <ion-icon name="arrow-back-outline" class="me-1"></ion-icon> হোম পেজে ফিরে যান
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>
@endsection
