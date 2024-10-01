$(document).ready(function () {
    var currentUrl = window.location.href;

    $.get(
        $("#box-gold").data("url"),
        function (data) {
            $("#box-gold").html(data);
        },
        "html"
    );

    $.get(
        $("#box-coin").data("url"),
        function (data) {
            $("#box-coin").html(data);
        },
        "html"
    );

    $(".main_nav_list a").each(function (index) {
        var href = $(this).attr("href");
        if (currentUrl == href) {
            $(this).addClass("active");

            if ($(this).data("parent")) {
                $('a[data-name="' + $(this).data("parent") + '"]').addClass(
                    "active"
                );
            }
        }
    });
});
