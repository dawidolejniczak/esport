var EsportApp = window.EsportApp = window.EsportApp || {};

(function ($) {
    EsportApp.init = function () {
        EsportApp.smoothScroll();
        EsportApp.toggleFilters();

    };

    EsportApp.smoothScroll = function () {
        $('a#top').click(function () {
            $('html, body').animate({scrollTop: 0}, 'slow');
            return false;
        });
    };

    EsportApp.toggleFilters = function () {
        $('#filters .link').on('click', function () {
            $(this).parents('#filters').toggleClass('open');
        });

    };

    $(document).on('ready', EsportApp.init);
    $(document).ready(function () {
        var i = $("input[name='games[]']:checked").length;
        $(".counter").find("span").text(i);
        $(".games-number").change(function () {
            if (this.checked) {
                i++;
                $(".counter").find("span").text(i);
            }else {
                i--;
                $(".counter").find("span").text(i);
            }
        });
    });
})(window.jQuery);
