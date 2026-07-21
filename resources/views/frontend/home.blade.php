@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp
@section('seodetails')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/amazingslider_thumbnail/amazingslider-1.css') }}">
@endsection

@section('title', $commonData['school_name'])
@section('content')
<?php
$helplines = [
    ['url' => 'https://333.gov.bd/', 'img' => 'Nagorik_Sheba.png', 'label' => 'সরকারি তথ্য ও সেবা', 'number' => '৩৩৩'],
    ['url' => 'https://www.999.gov.bd/', 'img' => '999.jpg', 'label' => 'জরুরি সেবা', 'number' => '৯৯৯'],
    ['url' => 'https://fireservice.gov.bd/', 'img' => 'fireservice.png', 'label' => 'ফায়ার সার্ভিস', 'number' => '১০২'],
    ['url' => 'https://www.supremecourt.gov.bd/web/', 'img' => 'court.png', 'label' => 'সুপ্রীম কোর্ট হেল্পলাইন', 'number' => '১০৩'],
    ['url' => 'https://acc.org.bd/', 'img' => 'dudok.png', 'label' => 'দুদক', 'number' => '১০৬'],
    ['url' => 'https://mowca.gov.bd/', 'img' => 'Helpline.avif', 'label' => 'নারী ও শিশু নির্যাতন', 'number' => '১০৯'],
    ['url' => 'https://msw.gov.bd/', 'img' => 'children.png', 'label' => 'শিশু সহায়তা', 'number' => '১০৯৮'],
    ['url' => 'https://land.gov.bd/', 'img' => 'land.png', 'label' => 'স্মার্ট ভূমি সেবা', 'number' => '১৬১২২'],
    ['url' => 'https://bkkb.gov.bd/', 'img' => 'bangladesh.png', 'label' => 'কর্মচারী কল্যাণ বোর্ড', 'number' => '১৬১০৯'],
];
?>
@include('layouts.banner')




<section class="categories container">

    <a href="{{ route('photos') }}"
        class="card d-flex flex-column align-items-center gap-2 text-decoration-none shadow-sm">
        <ion-icon name="images-outline"></ion-icon>
        <span>ছবি গ্যালারী</span>
    </a>

    <a href="{{ route('videos') }}"
        class="card d-flex flex-column align-items-center gap-2 text-decoration-none shadow-sm">
        <ion-icon name="videocam-outline"></ion-icon>
        <span>ভিডিও গ্যালারী</span>
    </a>

    <a href="{{ route('notice') }}"
        class="card d-flex flex-column align-items-center gap-2 text-decoration-none shadow-sm">
        <ion-icon name="notifications-outline"></ion-icon>
        <span>নোটিশ বোর্ড</span>
    </a>

    <a href="{{ route('results') }}"
        class="card d-flex flex-column align-items-center gap-2 text-decoration-none shadow-sm">
        <ion-icon name="bar-chart-outline"></ion-icon>
        <span>ফলাফল</span>
    </a>

    <a href="{{ route('online-form') }}"
        class="card d-flex flex-column align-items-center gap-2 text-decoration-none shadow-sm">
        <ion-icon name="document-text-outline"></ion-icon>
        <span>অনলাইন ফর্ম</span>
    </a>

</section>

<section class="vip-parallax-section">
    <div class="container">
        <h3 class="text-center mb-5 fw-bold h2 vip-main-title" style="color: var(--gov-green);">
            সম্মানিত পরিচালনা পর্ষদ ও প্রশাসন
        </h3>

        <div class="vip-grid">
            @foreach($faculties as $vip)
            <div class="vip-card">

                <div class="vip-title">
                    {{ $vip->position }}
                </div>

                <div class="vip-body">
                    @if($vip->image)
                    <img src="{{ $vip->image }}"
                        alt="{{ $vip->name }}">
                    @endif

                    <h5>{{ $vip->name }}</h5>
                    <p class="designation">{{ $vip->designation }}</p>
                </div>

            </div>
            @endforeach
        </div>

        <div class="secondary-info-block text-center mt-5">
            <h4 class="fw-bold">শিক্ষক মণ্ডলী ও প্রশাসন</h4>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                {{ $commonData['school_name'] }} এর উন্নয়নে এবং শিক্ষার্থীদের সেবায় নিয়োজিত আমাদের নিবেদিতপ্রাণ শিক্ষকমণ্ডলী ও প্রশাসন।
                যেকোনো প্রয়োজনে সরাসরি মাদরাসা কার্যালয়ে যোগাযোগ করুন।
            </p>
            <div class="title-divider"></div>
        </div>
    </div>
</section>

<main>
    <div class="container">
        <section class="statistics-section container shadow-sm">
            <h3 class="text-center mb-5 fw-bold h2" style="color: #198754;">
                {{ $commonData['school_name'] }} এর পরিসংখ্যান
            </h3>

            <?php
            $toBn = fn ($n) => strtr((string) $n, ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯']);
            $studentCount = $stats->student_count ?? null;
            $teacherCount = $stats->teacher_count ?? null;
            $passRate = $stats->pass_rate ?? null;
            ?>
            <div class="row px-3">
                <div class="col-md-4 col-6">
                    <div class="stat-card text-center">
                        <ion-icon name="people-circle-outline" style="font-size: 3.5rem; color: #2b6cb0;"></ion-icon>
                        <h4 class="fw-bold counter">{{ $studentCount !== null ? $toBn($studentCount).'+' : '১০০০+' }}</h4>
                        <p>মোট শিক্ষার্থী</p>
                    </div>
                </div>

                <div class="col-md-4 col-6">
                    <div class="stat-card text-center">
                        <ion-icon name="checkmark-done-circle-outline" style="font-size: 3.5rem; color: #198754;"></ion-icon>
                        <h4 class="fw-bold counter">{{ $passRate !== null ? $toBn($passRate).'%' : '৯৫%' }}</h4>
                        <p>পাসের হার</p>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="stat-card text-center">
                        <ion-icon name="hourglass-outline" style="font-size: 3.5rem; color: #dd6b20;"></ion-icon>
                        <h4 class="fw-bold counter">{{ $teacherCount !== null ? $toBn($teacherCount).'+' : '৫০+' }}</h4>
                        <p>অভিজ্ঞ শিক্ষক</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="family-banner">
        <div class="container banner-content">

            <div class="text-area">
                <h2 class="fw-bold">ভর্তি চলছে ২০২৫-২৬</h2>
                <h3>{{ $commonData['school_name'] }}</h3>

                <p>
                    ইবতেদায়ী থেকে কামিল পর্যন্ত সকল শ্রেণিতে ভর্তি চলছে।
                    আসন সীমিত — এখনই আবেদন করুন।
                </p>

                <div class="btn-group">
                    <a href="{{ route('admission-info') }}" class="apply-btn">ভর্তির তথ্য দেখুন</a>
                    <a href="{{ route('online-form') }}" class="info-btn">ভর্তি ফর্ম</a>
                </div>

                <small>সঠিক তথ্য ও প্রয়োজনীয় কাগজপত্র নিয়ে আসুন</small>
            </div>

            <div class="image-area">
                <img src="{{ asset('frontend/images/family.png') }}" alt="ভর্তি">
            </div>

        </div>
    </section>


    <div class="container">
        <div class="quick-services mb-5 mt-5" data-aos="fade-up">
            <h3 class="text-center mb-5 fw-bold h2" style="color: #198754;">
                একাডেমিক বিভাগ ও সেবাসমূহ
                <span class="d-block m-auto mt-2" style="width: 60px; height: 3px; background: #ff9900; border-radius: 10px;"></span>
            </h3>

            <div class="category-block mb-5">
                <div class="row g-4">
                    @foreach($schoolClasses as $class)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="service-card shadow-sm h-100 d-flex flex-column justify-content-center align-items-center p-4 text-center bg-white">
                            <div class="service-icon shadow-sm">
                                <ion-icon name="school-outline"></ion-icon>
                            </div>
                            <h6 class="fw-bold mt-3 mb-0">{{ $class->name }}</h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="quick-services mb-5 mt-5" data-aos="fade-up">
            <h3 class="text-center mb-5 fw-bold h2" style="color: #198754;">
                ই-সেবা
                <span class="d-block m-auto mt-2" style="width: 60px; height: 3px; background: #ff9900; border-radius: 10px;"></span>
            </h3>

            <div class="row g-4">
                @foreach ($eShebaCards as $eSheba)
                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                    <div class="service-card shadow-sm h-100 d-flex flex-column justify-content-between p-4 text-center bg-white">
                        <div>
                            <div class="service-icon shadow-sm">
                                <ion-icon name="{{ $eSheba->icon }}"></ion-icon>
                            </div>
                            <h6 class="fw-bold">{{ $eSheba->name }}</h6>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('eSheba.details', $eSheba->slug) }}"
                                class="c-button btn btn-sm w-100 rounded-pill">
                                বিস্তারিত
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="container mt-5 mb-5">
        <h3 class="text-center mb-5 fw-bold h2" style="color: #198754;">
            নোটিশ সমূহ
            <span class="d-block m-auto mt-2" style="width: 70px; height: 3px; background: #ff9900; border-radius: 10px;"></span>
        </h3>

        <div class="row g-4">
            @foreach ($noticetypes as $noticet)
            <div class="col-lg-6" data-aos="fade-up">
                <div class="feature-card shadow-sm p-4 rounded bg-white">
                    <h4 class="h4 mb-3">{{ $noticet->name }}</h4>
                    <p class="text-muted small">
                        {{ Str::limit($noticet->details, 120) }}
                    </p>

                    <ul class="feature-list mt-3">
                        @foreach ($noticet->items as $notice)
                        <li>
                            <a href="{{ route('notice.details', $notice->id) }}" class="d-flex align-items-center">
                                <ion-icon name="chevron-forward-circle-outline" class="me-2"></ion-icon>
                                <span>{{ $notice->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <div class="container">
        <div class="helpline-section mt-5">

            <div class="section-title text-center mb-4">
                <h3 class="fw-bold">
                    <ion-icon name="call-outline" class="text-danger"></ion-icon>
                    জরুরি সরকারি হেল্পলাইন ও সেবা নম্বর
                </h3>
                <p class="text-muted small mb-0">
                    সকল জরুরি ও প্রয়োজনীয় সরকারি সেবা এক জায়গায়
                </p>
            </div>

            <div class="row g-3">

                @foreach($helplines as $help)
                <div class="col-md-4 col-sm-6">

                    <a href="{{ $help['url'] }}" target="_blank" class="helpline-card">

                        <div class="helpline-left">
                            <img src="{{ asset('frontend/images/' . $help['img']) }}"
                                alt="{{ $help['label'] }}">
                        </div>

                        <div class="helpline-center">
                            <h6>{{ $help['label'] }}</h6>
                            <small>সরকারি হেল্পলাইন</small>
                        </div>

                        <div class="helpline-right">
                            <span>{{ $help['number'] }}</span>
                        </div>

                    </a>

                </div>
                @endforeach

            </div>

        </div>



        <div class="helpline-section mt-5">

            <div class="section-title text-center mb-4">
                <h3 class="fw-bold">
                    <ion-icon name="globe-outline" class="text-primary"></ion-icon>
                    কেন্দ্রীয় ই-সেবাসমূহ
                </h3>
                <p class="text-muted small mb-0">
                    সকল জরুরি ও প্রয়োজনীয় সরকারি সেবা এক জায়গায়
                </p>
            </div>


            <div class="row g-3">

                <div class="col-md-4 col-sm-6">
                    <a href="https://www.mygov.bd/" target="_blank" class="helpline-card">
                        <div class="helpline-left" style="width: 60% !important; height:auto !important">
                            <img src="{{ asset('frontend/images/service_link_5.jpg') }}" alt="myGov" style="width: 100% !important; height:auto !important">
                        </div>
                        <div style="width: 38% !important; height:auto !important; color:black">এক ঠিকানায় সরকারি সেবা</div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="https://www.mygov.bd/" target="_blank" class="helpline-card">
                        <div class="helpline-left" style="width: 60% !important; height:auto !important">
                            <img src="{{ asset('frontend/images/service_link_3.gif') }}" alt="myGov" style="width: 100% !important; height:auto !important">
                        </div>
                        <div style="width: 38% !important; height:auto !important; color:black">এই দপ্তরের ডিজিটাল সেবাসমূহ</div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="https://www.mygov.bd/" target="_blank" class="helpline-card">
                        <div class="helpline-left" style="width: 60% !important; height:auto !important">
                            <img src="{{ asset('frontend/images/e-directory.jpeg') }}" alt="myGov" style="width: 100% !important; height:auto !important">
                        </div>
                        <div style="width: 38% !important; height:auto !important; color:black">বাংলাদেশ ই-ডিরেক্টরি</div>
                    </a>
                </div>
            </div>

        </div>



        <div class="box left-margin-10 mt-5">
            <header class="section-header">
                <h3>ছবি গ্যালারী</h3>
                <a href="{{ route('photos') }}" class="view-all-btn">সব দেখুন</a>
            </header>
            <div class="row">
                @if ($photoGalleries != '')
                <?php $i = 0; ?>
                @foreach ($photoGalleries as $photo)
                <?php
                $i++;
                $photoImagePath = $photo->image;
                if ($photo->image != '') {
                    $coverImage = $photoImagePath;
                } else {
                    $coverImage = asset('assets/front/images/defaultlogo.png');
                }
                ?>
                <div class="col-sm-4 pt-2 pb-2">
                    <div class="gallery-item">
                        <a class="gallery-link glightbox" href="{{ $coverImage }}" data-gallery="myGallery">
                            <img src="{{ $coverImage }}"
                                alt="{{ $photo->name }}"
                                class="gallery-image">

                            <div class="gallery-caption">
                                {{ $photo->name }}
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</main>

@endsection
