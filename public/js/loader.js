$(document).ready(function () {
    //
    if ($('.loader').length) {
        let currentPercent = 0;
        $(".landing__title").fadeOut(0);
        $(".landing__buttons").fadeOut(0);
        $(".landing__guest").fadeOut(0);
        $(".loader__text").html(currentPercent);
        let compteur = setInterval(function () {
            $(".loader__text").html(currentPercent);
            $(".loader__text").attr("id", "percent-" + currentPercent);
            $(".loader__bar").attr('id', 'bar-' + currentPercent);
            currentPercent++;
            if (currentPercent > 100) {
                clearInterval(compteur);
                $('.loader').addClass('collapsed')
                setTimeout(function () {
                    $(".landing__title").fadeIn(800);
                    $(".landing__buttons").fadeIn(1100);
                    $(".landing__guest").fadeIn(800);

                }, 1000)
                setTimeout(function () {
                    $('header img').addClass('active')
                }, 700)
                $('.loader').addClass('collapsed');
            }
        }, );
    }
});