@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp
@section('seodetails')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/amazingslider_thumbnail/amazingslider-1.css') }}">
@endsection

@section('title', 'ফরিদপুর পৌরসভা')
@section('content')
<div class="row mt-3 body-cont">
    <div class="col-lg-9">
        <div class="home-text p-4 bg-white rounded shadow-sm mb-4">
            @if(!empty($homecontent))
            <h2>{{ $homecontent->title }}</h2>
            <p>{!! Str::limit($homecontent->content, 520) !!}</p>
            <a href="{{ route('websitecontent.slug', [$homecontent->menu->uri]) }}" class="readMore menu-right">বিস্তারিত
                দেখুন</a>
            @endif
        </div>

        <div class="statistics-section mb-5" data-aos="fade-up">
            <h3 class="text-center mb-4 fw-bold">ইউনিয়ন পরিষদের সেবার পরিসংখ্যান</h3>
            <div class="row g-3">
                <div class="col-md-4 col-6">
                    <div class="stat-card p-3 shadow-sm text-center">
                        <ion-icon name="people-circle-outline" style="font-size: 2.5rem; color: var(--gov-blue);"></ion-icon>
                        <h4 class="fw-bold mt-2">১২,৫৪০+</h4>
                        <p class="text-muted small mb-0">মোট সুবিধাভোগী</p>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-card p-3 shadow-sm text-center">
                        <ion-icon name="checkmark-done-circle-outline" style="font-size: 2.5rem; color: var(--gov-green);"></ion-icon>
                        <h4 class="fw-bold mt-2">৮,৯২০</h4>
                        <p class="text-muted small mb-0">সম্পন্নকৃত সেবা</p>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-card p-3 shadow-sm text-center">
                        <ion-icon name="hourglass-outline" style="font-size: 2.5rem; color: #ffc107;"></ion-icon>
                        <h4 class="fw-bold mt-2">৪৫০</h4>
                        <p class="text-muted small mb-0">চলমান আবেদন</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="quick-services mb-5" data-aos="fade-up">
            <h3 class="text-center mb-4 fw-bold" style="color: var(--gov-blue);">ডিজিটাল ই-সেবা কেন্দ্র</h3>

            @php
            // Group 1: Social Safety & Allowances
            $socialAllowances = [
            ['slug' => 'family-card', 'name' => 'ফ্যামিলি কার্ড', 'icon' => 'card-outline'],
            ['slug' => 'agriculture-card', 'name' => 'কৃষক কার্ড', 'icon' => 'leaf-outline'],
            ['slug' => 'age-stipend', 'name' => 'বয়স্ক ভাতা', 'icon' => 'man-outline'],
            ['slug' => 'widowed-allowance', 'name' => 'বিধবা ও স্বামী নিগৃহীতা ভাতা', 'icon' => 'woman-outline'],
            ['slug' => 'dgf-card', 'name' => 'ভিজিএফ কার্ড', 'icon' => 'fast-food-outline'],
            ['slug' => 'disability-certificate', 'name' => 'প্রতিবন্ধী সনদ', 'icon' => 'accessibility-outline'],
            ['slug' => 'orphan-certificate', 'name' => 'এতিম সনদপত্র', 'icon' => 'medkit-outline'],
            ];

            // Group 2: Personal & Identity Certificates
            $identityCerts = [
            ['slug' => 'citizenship-certificate', 'name' => 'নাগরিকত্ব সনদ', 'icon' => 'ribbon-outline'],
            ['slug' => 'nationality-certificate', 'name' => 'জাতীয়তা সনদ', 'icon' => 'finger-print-outline'],
            ['slug' => 'birth-certificate', 'name' => 'জন্ম নিবন্ধন', 'icon' => 'calendar-outline'],
            ['slug' => 'characteristic-certificate', 'name' => 'চারিত্রিক সনদ', 'icon' => 'shield-checkmark-outline'],
            ['slug' => 'marriage-certificate', 'name' => 'বিবাহিত সনদ', 'icon' => 'heart-outline'],
            ['slug' => 'single-certificate', 'name' => 'অবিবাহিত সনদ', 'icon' => 'person-outline'],
            ['slug' => 'permanent-resident-ertificate', 'name' => 'স্থায়ী বাসিন্দা সনদপত্র', 'icon' => 'home-outline'],
            ];

            // Group 3: Family & Community
            $familyCommunity = [
            ['slug' => 'heirship-certificate', 'name' => 'ওয়ারিশ সনদ', 'icon' => 'people-outline'],
            ['slug' => 'certificate', 'name' => 'প্রত্যয়ন পত্র', 'icon' => 'document-attach-outline'],
            ['slug' => 'childless-certificate', 'name' => 'নিঃসন্তান প্রত্যয়ন', 'icon' => 'person-add-outline'],
            ['slug' => 'community-certificate', 'name' => 'সম্প্রদায় সনদপত্র', 'icon' => 'people-circle-outline'],
            ];

            // Group 4: Business, Land & Legal
            $businessLegal = [
            ['slug' => 'trade-license', 'name' => 'ট্রেড লাইসেন্স', 'icon' => 'business-outline'],
            ['slug' => 'holding-tax', 'name' => 'হোল্ডিং ট্যাক্স ও খাজনা দাখিল', 'icon' => 'receipt-outline'],
            ['slug' => 'landless-certificate', 'name' => 'ভূমিহীন সনদ', 'icon' => 'map-outline'],
            ['slug' => 'no-objection-letter', 'name' => 'অনাপত্তি পত্র', 'icon' => 'document-lock-outline'],
            ];

            // Master array to loop through categories
            $allCategories = [
            ['title' => 'সামাজিক সুরক্ষা ও ভাতা', 'data' => $socialAllowances],
            ['title' => 'নাগরিকত্ব ও পরিচয়পত্রসমূহ', 'data' => $identityCerts],
            ['title' => 'পরিবার ও অন্যান্য প্রত্যয়ন', 'data' => $familyCommunity],
            ['title' => 'ব্যবসা, ভূমি ও অনাপত্তি', 'data' => $businessLegal],
            ];
            @endphp

            @foreach($allCategories as $category)
            <h5 class="category-header mt-4 mb-3" style="border-left: 5px solid var(--gov-blue); padding-left: 15px; font-weight: bold; color: #2c3e50;">
                {{ $category['title'] }}
            </h5>
            <div class="row">
                @foreach($category['data'] as $service)
                <div class="col-md-3 col-6 mb-4">
                    <div class="service-card shadow-sm h-100 d-flex flex-column justify-content-between p-3 text-center border rounded bg-white">
                        <div>
                            <div class="service-icon mb-3" style="font-size: 2rem; color: var(--gov-blue);">
                                <ion-icon name="{{ $service['icon'] }}"></ion-icon>
                            </div>
                            <h6 class="fw-bold" style="min-height: 2.5rem;">{{ $service['name'] }}</h6>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('application', $service['slug']) }}" class="c-button btn btn-sm btn-outline-primary w-100 rounded-pill">আবেদন করুন</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            <h3 class="text-center mb-4 fw-bold">আমাদের অন্যান্য সেবা</h3>
            <div class="row g-4">
                @foreach ($noticetypes as $noticet)
                <div class="col-lg-6">
                    <div class="feature-card shadow-sm p-4 rounded bg-white border">
                        <h4>{{ $noticet->name }}</h4>
                        <p class="text-muted small">{{ $noticet->details }}</p>
                        <ul class="feature-list mt-3">
                            @foreach ($noticet->items as $notice)
                            <li><a href="{{ route('notice.details', $notice->id) }}">{{ $notice->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="box left-margin-10 mt-5">
            <header class="section-header">
                <h3>ছবি গ্যালারী</h3>
                <a href="{{ route('photos') }}" class="view-all-btn">View All</a>
            </header>
            <div class="row">
                @if ($photoGalleries != '')
                <?php $i = 0; ?>
                @foreach ($photoGalleries as $photo)
                <?php
                $i++;
                $photoImagePath = asset('uploads/photogallery/' . $photo->image);
                if ($photo->image != '') {
                    $coverImage = $photoImagePath;
                } else {
                    $coverImage = asset('assets/front/images/defaultlogo.png');
                }
                ?>
                <div class="col-sm-6 pt-2 pb-2">
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
    <div class="col-lg-3">

        @php
        $vips = [
        [
        'title' => 'মাননীয় প্রধানমন্ত্রী',
        'name' => 'জনাব তারেক রহমান',
        'designation' => 'মাননীয় প্রধানমন্ত্রী',
        'office' => 'গণপ্রজাতন্ত্রী বাংলাদেশ সরকার',
        'image' => 'prime-minister.jpg'
        ],
        [
        'title' => 'মাননীয় মন্ত্রী',
        'name' => 'জনাব মির্জা ফখরুল ইসলাম আলমগীর, এমপি',
        'designation' => 'মাননীয় মন্ত্রী',
        'office' => 'স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়',
        'image' => 'mirza-fokhrul-islam.jpg'
        ],
        [
        'title' => 'মাননীয় প্রতিমন্ত্রী',
        'name' => 'জনাব মীর শাহে আলম, এমপি',
        'designation' => 'মাননীয় প্রতিমন্ত্রী',
        'office' => 'স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়',
        'image' => 'mir-saleh-ahmed.jpeg'
        ],
        [
        'title' => 'সচিব',
        'name' => 'জনাব মো: শহীদুল হাসান',
        'designation' => 'সচিব',
        'office' => 'স্থানীয় সরকার বিভাগ',
        'image' => 'jonab-shahidul-islam.jpeg'
        ]
        ];
        @endphp

        @foreach($vips as $vip)
        <div class="guest-item mb-4 shadow-sm border rounded bg-white text-center">
            <div class="section-header border-bottom mb-3">
                <h5 class="fw-bold m-0 text-white">{{ $vip['title'] }}</h5>
            </div>
            <div class="guest-profile  p-3">
                <img src="{{ asset('frontend/images/' . $vip['image']) }}"
                    alt="{{ $vip['name'] }}"
                    class="img-fluid rounded border mb-2"
                    style="width: 150px; height: 180px; object-fit: cover;">
                <p class="fw-bold m-0 text-primary">{{ $vip['name'] }}</p>
                <p class="small m-0 text-muted">{{ $vip['designation'] }}</p>
                <p class="x-small text-secondary">{{ $vip['office'] }}</p>
            </div>
        </div>
        @endforeach

        <div class="guest-item mb-4 shadow-sm border rounded bg-white p-3">
            <div class="section-header border-bottom mb-3">
                <h5 class="fw-bold m-0 text-white">যোগাযোগ ও অবস্থান</h5>
            </div>
            <div class="contact-info small">
                <p class="mb-2"><ion-icon name="location-outline"></ion-icon> কুমিল্লা আদর্শ সদর উপজেলা, কুমিল্লা, বাংলাদেশ</p>
                <p class="mb-3"><ion-icon name="mail-outline"></ion-icon> ইমেইল: amratoliup@gmail.com</p>
                <div class="map-container rounded overflow-hidden" style="height: 150px; background: #eee;">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3658.729764634491!2d91.1696047752266!3d23.5062411788377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754798b671f95fb%3A0xc87bb14e26747f3a!2z4KeqIOCmqOCmgiDgpobgpq7gp5zgpr7gpqTgprLgp4Ag4KaH4KaJ4Kao4Ka_4Kef4KaoIOCmquCmsOCmv-Cmt-Cmpg!5e0!3m2!1sen!2sbd!4v1776320835173!5m2!1sen!2sbd"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
        </div>

        @php
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
        @endphp

        <div class="guest-item mt-5 shadow-sm border rounded bg-white p-3">
            <div class="section-header border-bottom mb-3">
                <h5 class="fw-bold m-0 text-white"><ion-icon name="call-outline" class="text-danger"></ion-icon> জরুরি হেল্পলাইন নম্বর</h5>
            </div>
            <ul class="help-list list-unstyled m-0 p-0">
                @foreach($helplines as $help)
                <li class="help-list-item mb-2 pb-2 border-bottom">
                    <a href="{{ $help['url'] }}" target="_blank" class="text-decoration-none d-flex justify-content-between align-items-center">
                        <div class="help-info d-flex align-items-center">
                            <img src="{{ asset('frontend/images/' . $help['img']) }}"
                                alt="{{ $help['label'] }}"
                                style="width: 25px; height: 25px; margin-right: 10px; object-fit: contain;">
                            <span class="small text-dark">{{ $help['label'] }}</span>
                        </div>
                        <span class="badge bg-danger rounded-pill">{{ $help['number'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>


        <div class="guest-item mb-4 shadow-sm border rounded bg-white p-3">
            <div class="section-header mb-3" style="background-color: #3d8e41; color: white; padding: 10px; border-radius: 5px;">
                <h5 class="fw-bold m-0 text-white" style="font-size: 1.1rem;">কেন্দ্রীয় ই-সেবাসমূহ</h5>
            </div>
            <div class="e-service-links">
                <a href="https://www.mygov.bd/" target="_blank" class="d-block mb-2 border rounded p-2 text-center text-decoration-none bg-light">
                    <img src="{{ asset('frontend/images/service_link_5.jpg') }}" alt="myGov" class="img-fluid" style="max-height: 40px;">
                    <p class="small text-dark mt-1 mb-0 fw-bold">এক ঠিকানায় সরকারি সেবা</p>
                </a>
                <a href="#" class="d-block border rounded p-1 text-center text-decoration-none bg-white overflow-hidden">
                    <div style="background: linear-gradient(90deg, #f9fff9 0%, #e8f5e9 100%); padding: 5px;">
                        <img src="{{ asset('frontend/images/service_link_3.gif') }}" alt="Digital Service" class="img-fluid" style="max-height: 35px;">
                        <span class="small text-dark fw-bold ms-2" style="color: #6a2b8e !important;">এই দপ্তরের ডিজিটাল সেবাসমূহ</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="guest-item mb-4 shadow-sm border rounded bg-white p-3">
            <div class="section-header mb-3" style="background-color: #3d8e41; color: white; padding: 10px; border-radius: 5px;">
                <h5 class="fw-bold m-0  text-white" style="font-size: 1.1rem;">বাংলাদেশ ই-ডিরেক্টরি</h5>
            </div>
            <a href="https://bangladesh.gov.bd/site/view/officer_list" target="_blank" class="d-block border rounded mb-4 overflow-hidden text-decoration-none">
                <div class="d-flex align-items-center p-2 bg-light">
                    <img src="{{ asset('frontend/images/e-directory.jpeg') }}" alt="Directory" style="width: 40px; height: 40px;">
                    <div class="ms-2">
                        <p class="small fw-bold mb-0 text-dark">বাংলাদেশ ই-ডিরেক্টরি</p>
                        <p class="x-small text-muted mb-0">সকল সরকারি কর্মকর্তার তথ্য</p>
                    </div>
                </div>
            </a>

            <div class="section-header mb-3" style="background-color: #3d8e41; color: white; padding: 10px; border-radius: 5px;">
                <h5 class="fw-bold m-0  text-white" style="font-size: 1.1rem;">জাতীয় সঙ্গীত</h5>
            </div>
            <div class="audio-player bg-light p-2 rounded text-center">
                <audio controls style="width: 100%; height: 40px;">
                    <source src="{{ asset('frontend/images/bd_national_anthem.mp3') }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>

    </div>

    <style>
        .x-small {
            font-size: 0.75rem;
        }

        .help-list-item:last-child {
            border: none;
        }

        .help-list-item a:hover .text-dark {
            color: #0d6efd !important;
        }

        .guest-item {
            transition: transform 0.2s;
        }

        .guest-item:hover {
            transform: scale(1.02);
        }
    </style>
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <div class="guest-modal-profile">
                    <div class="photo-frame">
                        <img src="{{ asset('frontend/images/prime-minister.jpeg') }}"
                            alt="">
                        <h4 class="mt-2">মাননীয় প্রধানমন্ত্রী</h4>
                        <p>জনাব তারেক রহমান</p>
                    </div>
                    <div class="profile-text text-center mt-4">
                        <p>
                            <span style="color:#333; font-family: SolaimanLipi, Arial, sans-serif; text-align: justify;">
                                <p>ফরিদপুর পৌরসভা আমাদের প্রিয়
                                    নগরবাসীর জীবনমান উন্নয়ন, নাগরিক সেবা নিশ্চিতকরণ ও টেকসই উন্নয়ন বাস্তবায়নের
                                    জন্য নিরলসভাবে কাজ করে যাচ্ছে। সরকারের উন্নয়নমূলক কর্মকাণ্ডকে সফল করতে আমরা
                                    আধুনিক, জনবান্ধব ও প্রযুক্তিনির্ভর সেবা চালু করেছি যাতে প্রতিটি নাগরিক সহজে
                                    সুবিধা পান। </p><br>
                                <p>আমরা বিশ্বাস করি নাগরিকদের অংশগ্রহণ ও সহযোগিতা ছাড়া উন্নয়ন
                                    কার্যক্রম সম্পূর্ণ নয়। তাই আমি পৌরবাসীর প্রতি উদাত্ত আহ্বান জানাই— আপনারা
                                    ইউনিয়ন পরিষদের কার্যক্রমে সরাসরি অংশ নিন, মতামত দিন এবং ইউনিয়ন পরিষদের উন্নয়নে সক্রিয় ভূমিকা
                                    রাখুন। চলুন, একসাথে মিলে ফরিদপুর পৌরসভাকে একটি আধুনিক, সুন্দর ও বাসযোগ্য শহর
                                    হিসেবে গড়ে তুলি।</p>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-5">
                <div class="guest-modal-profile">
                    <div class="photo-frame">
                        <img src="{{ asset('frontend/images/ict-minister.jpeg') }}"
                            alt="">
                        <h4 class="mt-2">ডাক, টেলিযোগাযোগ ও তথ্যপ্রযুক্তি মন্ত্রণালয়</h4>
                        <p>জনাব ফকির মাহবুব আনাম</p>
                    </div>
                    <div class="profile-text text-center mt-4">
                        <p>
                            <span style="color:#333; font-family: SolaimanLipi, Arial, sans-serif; text-align: justify;">
                                <p>ফরিদপুর পৌরসভা তথ্য ও যোগাযোগ প্রযুক্তি (আইসিটি) বিভাগের সহায়তায় আমাদের প্রিয় নাগরিকদের ডিজিটাল জীবনমান উন্নয়ন, আধুনিক সেবা নিশ্চিতকরণ এবং টেকসই উন্নয়ন বাস্তবায়নের লক্ষ্যে নিরলসভাবে কাজ করে যাচ্ছে। সরকারের ডিজিটাল বাংলাদেশ
                                    গড়ার ভিশন বাস্তবায়নে আমরা প্রযুক্তিনির্ভর, জনবান্ধব ও উদ্ভাবনী সেবা চালু করেছি, যাতে প্রতিটি নাগরিক সহজেই প্রয়োজনীয় সেবা গ্রহণ করতে পারেন।</p><br>

                                <p>আমরা বিশ্বাস করি, নাগরিকদের সক্রিয় অংশগ্রহণ ও সহযোগিতা ছাড়া এই ডিজিটাল রূপান্তর সম্পূর্ণ নয়। তাই ফরিদপুর পৌরসভাের পক্ষ থেকে সকল নাগরিকের প্রতি আন্তরিক আহ্বান— আপনারা প্রযুক্তির সঠিক ব্যবহার নিশ্চিত করুন, ডিজিটাল সেবাগুলো গ্রহণ করুন এবং স্থানীয় উন্নয়নে সক্রিয়ভাবে অংশগ্রহণ করুন।</p><br>

                                <p>চলুন, আমরা সবাই মিলে ফরিদপুর পৌরসভাকে একটি আধুনিক, প্রযুক্তিনির্ভর ও স্মার্ট ইউনিয়ন হিসেবে গড়ে তুলি।</p>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection