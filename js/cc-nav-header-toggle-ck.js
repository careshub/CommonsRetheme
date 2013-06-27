jQuery(document).ready(function() {
    function e() {
        jQuery("#login-item").addClass("toggled");
        jQuery("#login-item .pop-sub-wrapper").addClass("toggled");
        jQuery("#sidebar-user-login").focus();
    }
    function t() {
        if (jQuery("#sidebar-user-login").val() === "" && jQuery("#sidebar-user-pass").val() === "") {
            jQuery("#login-item").removeClass("toggled");
            jQuery("#login-item .pop-sub-wrapper").removeClass("toggled");
            jQuery("#sidebar-user-login").blur();
        }
    }
    jQuery("#menu-toggler").click(function() {
        jQuery(".nav-container").toggleClass("toggled");
        return !1;
    });
    var n = {
        over: e,
        timeout: 500,
        out: t
    };
    jQuery("#login-item").hoverIntent(n);
    jQuery("#cancel-login").click(function() {
        jQuery("#login-item").removeClass("toggled");
        jQuery("#login-item .pop-sub-wrapper").removeClass("toggled");
        return !1;
    });
});