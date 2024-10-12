$(document).ready(function(){
    var lazyLoadInstance = new LazyLoad({elements_selector:"img.lazy, video.lazy, div.lazy, section.lazy, header.lazy, footer.lazy,iframe.lazy"});
});


$('.slider').slick({
dots: true,
infinite: true,
speed: 600,
slidesToShow: 1,
autoplay: true,
autoplaySpeed: 3000,
adaptiveHeight: true
});
