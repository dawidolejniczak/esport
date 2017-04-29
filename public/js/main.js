var EsportApp = window.EsportApp = window.EsportApp || {};

(function ($) {
    EsportApp.init = function () {
        EsportApp.smoothScroll();
        EsportApp.toggleFilters();

    };

    EsportApp.smoothScroll = function () {
        $('a#top').click(function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            return false;
        });
    };

    EsportApp.toggleFilters = function () {
      $('#filters .link').on('click', function () {
            $(this).parents('#filters').toggleClass('open');
      });

    };

    $(document).on('ready', EsportApp.init);

})(window.jQuery);