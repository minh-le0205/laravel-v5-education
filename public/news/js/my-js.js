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

    // Save form info to localStorage
    $("#contact_form").on("submit", function () {
        localStorage.setItem(
            "full_name",
            $('#contact_form [name="full_name"]').val()
        );

        localStorage.setItem("email", $('#contact_form [name="email"]').val());

        localStorage.setItem("phone", $('#contact_form [name="phone"]').val());
    });

    if ($("#contact_form").length > 0) {
        $('#contact_form [name="full_name"]').val(
            localStorage.getItem("full_name")
        );

        $('#contact_form [name="email"]').val(localStorage.getItem("email"));

        $('#contact_form [name="phone"]').val(localStorage.getItem("phone"));
    }
});
