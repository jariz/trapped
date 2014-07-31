var main = function () {
    switch (window.location.pathname) {
        case "/":
            var target = $(".hero");
            var trianglify = new Trianglify();

            var res = function() {
                target.css("background-image", trianglify.generate(target.width(), target.height()).dataUrl);
            };
            res();

            $(window).resize(res);


            $('.grid.row').infinitescroll({
                navSelector: ".pagination",
                nextSelector: ".pagination a:last",
                itemSelector: ".grid.row .item"
            }, function() {
                Player.init();
            });
            break;
        case "/radio":
            $(".airtime").airtimeShowSchedule({
                sourceDomain: "http://radio.trapped.io/",
                text: {onAirToday: "Today's program"},
                updatePeriod: 99999 //epic hax
            });

            break;
    }
};
$(document).ready(main).bind("trapped:nav", main);