// remap jQuery to $
(function ($) {
  $(document).ready(function () {
    $("#menuHeader").click(function () {
      $(".menu-mobile-nav").slideToggle("fast", function () {});
    });

    $("#headerSearch").click(function () {
      $(".product-search-container").slideToggle("fast", function () {});
    });

    $(".js-slider-home").slick({
      dots: true,
      arrows: false,
    });
  });

  $(window).load(function () {});

  $(window).resize(function () {});
})(window.jQuery);
