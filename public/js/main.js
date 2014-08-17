var main = function () {
    var ath = false;
    if(!ath) {
        ath = true;
        addToHomescreen();
    }

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
                navSelector: "#homePaginator .pagination",
                nextSelector: "#homePaginator .pagination a:last",
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

    switch(window.location.pathname.substr(0, 4)) {
        case "/hot":
        case "/top":
            $("#content .container").infinitescroll({
                navSelector: "#subredditPaginator .pagination",
                nextSelector: "#subredditPaginator .pagination a:last",
                itemSelector: "#content .container .media"
            })

            break;
    }
};
$(document).ready(main).bind("trapped:nav", main);