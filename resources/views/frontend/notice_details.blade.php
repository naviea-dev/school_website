@extends('layouts.app')

@section('title', $notices->name)

@section('content')
<main class="bg-light py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success">হোম</a></li>
                <li class="breadcrumb-item"><a href="{{ route('notice') }}" class="text-decoration-none text-success">নোটিশ</a></li>
                <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 200px;">{{ $notices->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-8">
                <article class="article-container shadow-sm p-4 p-md-5">

                    @if($notices->image)
                    <div class="mb-4">
                        <img src="{{ $notices->image }}" alt="{{ $notices->name }}" class="notice-main-img shadow-sm">
                    </div>
                    @endif

                    <header class="article-header">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">অফিসিয়াল নোটিশ</span>
                            <button onclick="window.print()" class="btn btn-sm btn-print d-flex align-items-center gap-2">
                                <ion-icon name="print-outline"></ion-icon> প্রিন্ট করুন
                            </button>
                        </div>

                        <h1 class="article-title mb-3">{{ ucfirst($notices->name) }}</h1>

                        <div class="meta-info">
                            <span class="d-flex align-items-center gap-1">
                                <ion-icon name="calendar-outline"></ion-icon>
                                প্রকাশিত: {{ date('d F, Y', strtotime($notices->updated_at)) }}
                            </span>
                            <span class="d-flex align-items-center gap-1">
                                <ion-icon name="eye-outline"></ion-icon>
                                {{ $commonData['school_name'] }}
                            </span>
                        </div>
                    </header>

                    <div class="notice-body text-break">
                        {!! $notices->details !!}
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <p class="fw-bold text-muted mb-2 small text-uppercase">এই নোটিশটি শেয়ার করুন</p>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-primary btn-sm rounded-circle"><ion-icon name="logo-facebook" class="p-1"></ion-icon></a>
                            <a href="https://wa.me/?text={{ $notices->name }} - {{ url()->current() }}" target="_blank" class="btn btn-success btn-sm rounded-circle"><ion-icon name="logo-whatsapp" class="p-1"></ion-icon></a>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <aside class="sidebar-sticky">
                    <div class="sidebar-card shadow-sm">
                        <h3 class="sidebar-title d-flex align-items-center gap-2">
                            <ion-icon name="notifications-outline"></ion-icon>
                            অন্যান্য নোটিশ
                        </h3>
                        <div class="related-notice-list">
                            @forelse($relnotices as $lnotices)
                            <div class="related-item">
                                <a href="{{ route('notice.details', $lnotices->id) }}" class="related-link">
                                    <div class="small text-muted mb-1">{{ date('d M, Y', strtotime($lnotices->updated_at)) }}</div>
                                    <div class="text-dark fw-bold line-clamp-2">
                                        {!! strip_tags(Str::limit($lnotices->name, 70)) !!}
                                    </div>
                                </a>
                            </div>
                            @empty
                            <div class="p-4 text-center text-muted small">কোন তথ্য নেই</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="mt-4 p-4 bg-success rounded-4 text-white shadow-sm">
                        <h5 class="fw-bold">সাহায্য প্রয়োজন?</h5>
                        <p class="small opacity-75">মাদরাসা সংক্রান্ত যেকোনো তথ্যের জন্য সরাসরি যোগাযোগ করুন।</p>
                        <a href="/content/contact" class="btn btn-light btn-sm w-100 fw-bold rounded-pill text-success">যোগাযোগ করুন</a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</main>
@endsection
