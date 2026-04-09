<script>
    !function($) {
        "use strict";

        var Ubold = function() {};

        Ubold.prototype.initStickyMenu = function() {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 50) {
                    $(".sticky").addClass("nav-sticky");
                } else {
                    $(".sticky").removeClass("nav-sticky");
                }
            });
        };

        Ubold.prototype.initBacktoTop = function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });

            $('.back-to-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);
                return false;
            });
        };

        Ubold.prototype.init = function() {
            this.initStickyMenu();
            this.initBacktoTop();
        };

        $.Ubold = new Ubold();
        $.Ubold.Constructor = Ubold;
        $.Ubold.init();
    }(window.jQuery);
</script>
