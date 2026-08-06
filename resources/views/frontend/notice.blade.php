@extends('layouts.app')

@section('title', 'নোটিশ বোর্ড — '.$commonData['school_name'])

@section('content')
<main id="main" class="bg-light py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="section-title text-dark fw-bold">নোটিশ বোর্ড</h3>
                <p class="text-muted">
                    @if($activeType)
                        <strong>{{ $activeType->name }}</strong> বিভাগের নোটিশ।
                        <a href="{{ route('notice') }}" class="text-success text-decoration-none fw-bold">সকল নোটিশ দেখুন</a>
                    @else
                        মাদরাসার সর্বশেষ নোটিশ, বিজ্ঞপ্তি ও গুরুত্বপূর্ণ তথ্য এখানে পাবেন।
                    @endif
                </p>
            </div>
        </div>

        @if($noticeTypes->count() > 1)
        <div class="row mb-4">
            <div class="col-12 d-flex flex-wrap gap-2">
                <a href="{{ route('notice') }}"
                   class="badge rounded-pill px-3 py-2 text-decoration-none {{ !$activeType ? 'bg-success text-white' : 'bg-success-subtle text-success' }}">
                    সকল
                </a>
                @foreach($noticeTypes as $type)
                <a href="{{ route('notice', ['type' => $type->id]) }}"
                   class="badge rounded-pill px-3 py-2 text-decoration-none {{ $activeType && $activeType->id === $type->id ? 'bg-success text-white' : 'bg-success-subtle text-success' }}">
                    {{ $type->name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row g-4">
            @forelse($notices as $lnotice)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                <article class="notice-card shadow-sm rounded-4 h-100">
                    <a href="{{ route('notice.details', [$lnotice->id]) }}" class="notice-img-wrapper">
                        @if($lnotice->image)
                            <img src="{{ $lnotice->image }}"
                                 alt="{{ $lnotice->name }}"
                                 class="notice-img">
                        @else
                            <img src="{{ asset('assets/front/images/default-service.jpg') }}" 
                                 alt="Default" 
                                 class="notice-img">
                        @endif
                    </a>
                    
                    <div class="notice-content p-4 d-flex flex-column flex-grow-1">
                        <div class="mb-2">
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill small fw-bold">মাদরাসা নোটিশ</span>
                        </div>
                        
                        <h5 class="notice-title mb-3">
                            <a href="{{ route('notice.details', [$lnotice->id]) }}" class="text-decoration-none">
                                {!! strip_tags(Str::limit($lnotice->name, 55)) !!}
                            </a>
                        </h5>
                        
                        <div class="notice-desc mb-4">
                            {!! strip_tags(Str::limit($lnotice->details, 110)) !!}
                        </div>
                        
                        <div class="mt-auto">
                            <a href="{{ route('notice.details', [$lnotice->id]) }}" class="read-more d-flex align-items-center text-decoration-none text-success fw-bold">
                                বিস্তারিত দেখুন 
                                <ion-icon name="arrow-forward-circle-outline" class="ms-2 fs-5"></ion-icon>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <ion-icon name="document-text-outline" style="font-size: 4rem; color: #dee2e6;"></ion-icon>
                    <h4 class="mt-3 text-muted">কোন নোটিশ খুঁজে পাওয়া যায়নি</h4>
                </div>
            </div>
            @endforelse
        </div>

        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <div class="pagination-wrapper px-4 py-2 bg-white rounded-pill shadow-sm">
                    {{ $notices->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection