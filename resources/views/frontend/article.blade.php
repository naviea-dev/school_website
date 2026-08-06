@extends('layouts.app')

@section('title', $articles ? $articles->title : $commonData['school_name'])

@section('content')
<style>
    /* Consistent Article Styling */
    .article-container {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .article-main-img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 12px;
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
        line-height: 1.3;
    }

    .meta-info {
        font-size: 0.95rem;
        color: #718096;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .article-body {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #3d4852;
        font-family: 'Hind Siliguri', sans-serif;
    }

    /* Handling dynamic images/tables inside the content */
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    .article-body table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
        border-color: #dee2e6;
    }

    /* Print & Action Buttons */
    .action-btn {
        border: 1px solid #dee2e6;
        color: #6c757d;
        font-weight: 600;
        transition: all 0.3s;
    }

    .action-btn:hover {
        background: #f8fdfa;
        color: #198754;
        border-color: #198754;
    }
</style>

<main class="bg-light py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4 d-print-none">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success">হোম</a></li>
                <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 300px;">
                    {{ $articles ? $articles->title : 'আর্টিকেল' }}
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($articles)
                <article class="article-container shadow-sm p-4 p-md-5">

                    @if($articles->image)
                    <div class="mb-5">
                        <img src="{{ $articles->image }}"
                            alt="{{ $articles->title }}"
                            class="article-main-img shadow-sm">
                    </div>
                    @endif

                    <header class="article-header">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm">নিবন্ধ / আর্টিকেল</span>
                            <div class="d-flex gap-2 d-print-none">
                                <button onclick="window.print()" class="btn btn-sm action-btn d-flex align-items-center gap-2">
                                    <ion-icon name="print-outline"></ion-icon> প্রিন্ট
                                </button>
                            </div>
                        </div>

                        <h1 class="article-title display-6 mb-3">{{ $articles->title }}</h1>

                        <div class="meta-info">
                            <span class="d-flex align-items-center gap-2">
                                <ion-icon name="calendar-outline" class="text-success"></ion-icon>
                                প্রকাশিত: {{ $articles->created_at }}
                            </span>
                            <span class="d-flex align-items-center gap-2">
                                <ion-icon name="business-outline" class="text-success"></ion-icon>
                                {{ $commonData['school_name'] }}
                            </span>
                        </div>
                    </header>

                    <div class="article-body">
                        {!! $articles->content !!}
                    </div>

                    <div class="mt-5 pt-4 border-top d-print-none">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="fw-bold text-muted mb-0">শেয়ার করুন:</p>
                                <div class="d-flex gap-2 mt-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle">
                                        <ion-icon name="logo-facebook"></ion-icon>
                                    </a>
                                    <a href="https://wa.me/?text={{ $articles->title }} - {{ url()->current() }}" target="_blank" class="btn btn-outline-success btn-sm rounded-circle">
                                        <ion-icon name="logo-whatsapp"></ion-icon>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <a href="{{ url()->previous() }}" class="btn btn-success rounded-pill px-4">
                                    <ion-icon name="arrow-back-outline" class="me-1"></ion-icon> ফিরে যান
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
                @else

                <div class="article-container shadow-sm p-5 text-center">

                    <ion-icon
                        name="document-text-outline"
                        style="font-size: 80px; color:#adb5bd;">
                    </ion-icon>

                    <h3 class="mt-4 text-muted">
                        কোনো তথ্য পাওয়া যায়নি
                    </h3>

                    <p class="text-secondary">
                        দুঃখিত, এই পেজের জন্য কোনো কনটেন্ট পাওয়া যায়নি।
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4 mt-3">
                        <ion-icon name="home-outline" class="me-1"></ion-icon>
                        হোম পেজে ফিরে যান
                    </a>

                </div>

                @endif
            </div>
        </div>
    </div>
</main>
@endsection