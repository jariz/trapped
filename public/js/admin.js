(function($){
    $(document).ready(function() {
        $(".forgot-password").click(function() {
            $(".form-login").slideUp(function() {
                $(".form-forgot").slideDown();
            })
            return false;
        });

        $(".link-login").click(function() {
            $(".form-forgot").slideUp(function() {
                $(".form-login").slideDown();
            })
            return false;
        });

        setTimeout(function() {
            $(".alert-floating").addClass("in");
        }, 200)
    });
})(jQuery);
