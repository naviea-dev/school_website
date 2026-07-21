@extends('layouts.app')

@section('title', 'ভর্তির তথ্য')

@section('content')
<div class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #198754;">ভর্তির তথ্য</h2>
        <h5 class="text-muted">{{ $commonData['school_name'] }} — শিক্ষাবর্ষ ২০২৫-২৬</h5>
        <span class="d-block m-auto mt-2" style="width: 60px; height: 3px; background: #ff9900; border-radius: 10px;"></span>
    </div>

    <div class="row g-4 align-items-start">
        <div class="col-lg-8">

            <div class="feature-card shadow-sm p-4 rounded bg-white mb-4">
                <h4 class="fw-bold mb-3"><ion-icon name="school-outline" class="me-2"></ion-icon>ভর্তি প্রক্রিয়া</h4>
                <p>
                    ইবতেদায়ী থেকে কামিল পর্যন্ত সকল শ্রেণিতে ২০২৫-২৬ শিক্ষাবর্ষের ভর্তি কার্যক্রম চলছে। আগ্রহী অভিভাবক ও
                    শিক্ষার্থীদের নিচের "অনলাইন ভর্তি ফর্ম" পূরণ করে আবেদন করতে হবে। আসন সংখ্যা সীমিত, তাই যত দ্রুত সম্ভব
                    আবেদন সম্পন্ন করার অনুরোধ করা হচ্ছে।
                </p>
            </div>

            <div class="feature-card shadow-sm p-4 rounded bg-white mb-4">
                <h4 class="fw-bold mb-3"><ion-icon name="document-text-outline" class="me-2"></ion-icon>প্রয়োজনীয় কাগজপত্র</h4>
                <ul class="feature-list">
                    <li><ion-icon name="chevron-forward-circle-outline" class="me-2"></ion-icon><span>শিক্ষার্থীর জন্ম নিবন্ধন সনদের ফটোকপি</span></li>
                    <li><ion-icon name="chevron-forward-circle-outline" class="me-2"></ion-icon><span>পূর্ববর্তী প্রতিষ্ঠানের সর্বশেষ পরীক্ষার ফলাফল / প্রশংসাপত্র (যদি থাকে)</span></li>
                    <li><ion-icon name="chevron-forward-circle-outline" class="me-2"></ion-icon><span>অভিভাবকের জাতীয় পরিচয়পত্রের ফটোকপি</span></li>
                    <li><ion-icon name="chevron-forward-circle-outline" class="me-2"></ion-icon><span>শিক্ষার্থীর সদ্য তোলা রঙিন পাসপোর্ট সাইজ ছবি</span></li>
                </ul>
            </div>

            <div class="feature-card shadow-sm p-4 rounded bg-white">
                <h4 class="fw-bold mb-3"><ion-icon name="help-circle-outline" class="me-2"></ion-icon>যোগাযোগ</h4>
                <p class="mb-0">
                    ভর্তি সংক্রান্ত যেকোনো জিজ্ঞাসায় মাদরাসা কার্যালয়ে সরাসরি যোগাযোগ করুন, অথবা
                    <a href="{{ route('notice') }}">নোটিশ বোর্ডে</a> প্রকাশিত সর্বশেষ ভর্তি বিজ্ঞপ্তি দেখুন।
                </p>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="feature-card shadow-sm p-4 rounded bg-white text-center">
                <ion-icon name="person-add-outline" style="font-size: 3rem; color: #198754;"></ion-icon>
                <h5 class="fw-bold mt-3 mb-2">অনলাইনে আবেদন করুন</h5>
                <p class="text-muted small">ফর্ম পূরণ করে সরাসরি আবেদন জমা দিন।</p>
                <a href="{{ route('online-form') }}" class="c-button btn w-100 rounded-pill">ভর্তি ফর্ম</a>
            </div>
        </div>
    </div>

</div>
@endsection
