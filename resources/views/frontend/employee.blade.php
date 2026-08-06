@extends('layouts.app')

@section('title', 'শিক্ষক মণ্ডলী')

@section('sidebar')
    @parent
@endsection

@section('content')
<main id="main" class="bg-light py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="section-title text-dark fw-bold">শিক্ষক মণ্ডলী</h3>
                <p class="text-muted">প্রতিষ্ঠানের সকল শিক্ষকের তালিকা।</p>
            </div>
        </div>

        @if($allemployee->isNotEmpty())
            @include('frontend.partials.vip-grid', ['members' => $allemployee, 'gridKey' => 'members'])
        @else
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <ion-icon name="people-outline" style="font-size: 4rem; color: #dee2e6;"></ion-icon>
                    <h4 class="mt-3 text-muted">কোন শিক্ষক তথ্য পাওয়া যায়নি</h4>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection

@section('footer')
    @parent
@endsection
