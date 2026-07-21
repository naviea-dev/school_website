$(function () {
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      loop: true, 
      autoplay: {
        delay: 4000, 
        disableOnInteraction: false,
      },
      speed: 1000,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  });
  
  
  // countup
  $(".counter").countUp();
  
  // Aos Animation
  AOS.init();
  
  // lighBox
  lightbox.option({
    resizeDuration: 200,
    wrapAround: true,
  });
  
  // VenuBox
  new VenoBox({
    selector: ".my-video-links",
  });