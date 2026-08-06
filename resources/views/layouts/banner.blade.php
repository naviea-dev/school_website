<section class="hero-slider">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
            <div class="swiper-slide slide" style="background-image: url('{{ $banner->image }}')">
            </div>
            @endforeach
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
