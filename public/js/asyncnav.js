var ASyncNav = {
    initialized: false,
    hooked: [],
    init: function () {
        if (!("domain" in window) || !("History" in window)) {
            throw "Missing resources, can't initialize async nav module";
        }
        window.onpopstate = function () {
            ASyncNav.nav(window.location);
        }
        $("a:not([data-no-async='true'])").each(function () {
            var gud = $._data(this, 'events');
            if (typeof gud == "undefined" || (typeof gud != "undefined" && gud.click && gud.click.length == 0)) {
                $(this).click(function (e) {
                    var href = $(this).attr("href");

                    //does this link reference to a page on this site?
                    if ($(this).attr("target") == undefined && $(this).attr("href").substr(0, domain.length) == domain) {

                        //check if brand
                        try {
                            if($(this).hasClass("navbar-brand")) {
                                $(this).parent().parent().find(".navbar-nav li").removeClass("active");
                            }
                        }
                        catch(e) {}

                        //check if it's part of the nav
                        try {
                            if($(this).parent().parent().hasClass("navbar-nav")) {
                                //si
                                $(this).parent().parent().children().removeClass("active");
                                $(this).parent().addClass("active");
                            }
                        }
                        catch(e) {
                            //whatevz
                        }

                        //hijack
                        e.preventDefault();
                        ASyncNav.nav(href);
                    } else if(href.substr(0, "http://radio.trapped.io".length) != "http://radio.trapped.io"){
                        e.preventDefault();
                        window.open(href);
                    }
                })
            }
        });
    },
    nav: function (href) {
        History.pushState(href, "TRAPPED", href);
        $.get(
            href,
            {
                "plain": "yup"
            },
            function (dataz) {
                $("#content").html(dataz);
                if ("TrappedExports" in window && "title" in TrappedExports) {
                    document.title = TrappedExports.title;
                    Player.appendTitle();
                }
                //reinit errything
                $(document).trigger("trapped:nav");
            }
        )
    }
};

$(document).ready(ASyncNav.init).bind("trapped:nav", ASyncNav.init);