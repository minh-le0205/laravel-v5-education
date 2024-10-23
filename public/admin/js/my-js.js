$(document).ready(function () {
    let $btnSearch = $("button#btn-search");
    let $btnClearSearch = $("button#btn-clear-search");

    let $inputSearchField = $("input[name  = search_field]");
    let $inputSearchValue = $("input[name  = search_value]");
    let $selectChangeAttr = $("select[name = select_change_attr]");
    let orderingInput = $("input.ordering");

    $("a.select-field").click(function (e) {
        e.preventDefault();

        let field = $(this).data("field");
        let fieldName = $(this).html();
        $("button.btn-active-field").html(
            fieldName + ' <span class="caret"></span>'
        );
        $inputSearchField.val(field);
    });

    $btnSearch.click(function () {
        var pathname = window.location.pathname;
        let params = ["filter_status"];
        let searchParams = new URLSearchParams(window.location.search); // ?filter_status=active

        let link = "";
        $.each(params, function (key, param) {
            // filter_status
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&"; // filter_status=active
            }
        });

        let search_field = $inputSearchField.val();
        let search_value = $inputSearchValue.val();

        if (search_value.replace(/\s/g, "") == "") {
            alert("Nhập vào giá trị cần tìm !!");
        } else {
            window.location.href =
                pathname +
                "?" +
                link +
                "search_field=" +
                search_field +
                "&search_value=" +
                search_value;
        }
    });

    $btnClearSearch.click(function () {
        var pathname = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);

        params = ["filter_status"];

        let link = "";
        $.each(params, function (key, param) {
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&";
            }
        });

        window.location.href = pathname + "?" + link.slice(0, -1);
    });

    $(".btn-delete").on("click", function () {
        if (!confirm("Bạn có chắc muốn xóa phần tử?")) return false;
    });

    $(".status-ajax, .is-home-ajax").on("click", function () {
        let url = $(this).data("url");
        let btn = $(this);
        let currentBtnClass = btn.data("class");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                btn.data("url", response.route);
                btn.data("class", response.statusObj.class);
                btn.removeClass(currentBtnClass);
                btn.addClass(response.statusObj.class);
                btn.html(response.statusObj.name);
                btn.notify("Thành công", {
                    position: "top center",
                    className: "success",
                });
            },
        });
    });

    $selectChangeAttr.on("change", function () {
        let ele = $(this);
        let selectValue = $(this).val();
        let url = $(this).data("url");
        url = url.replace("value_new", selectValue);
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                ele.notify("Cập nhật thành công", {
                    position: "top center",
                    className: "success",
                });
            },
        });
    });

    orderingInput.on("change", function (e) {
        let ele = $(this);
        let url = ele.data("url");
        let value = ele.val();
        $.ajax({
            type: "GET",
            url: url.replace("value_new", value),
            dataType: "Json",
            success: function (response) {
                ele.notify("Cập nhật thành công", {
                    position: "top center",
                    className: "success",
                });
            },
        });
    });

    $('select[name="filter_category"]').on("change", function () {
        var pathName = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);
        params = ["filter_status", "search_field", "search_value"];
        let link = "";

        $.each(params, function (key, value) {
            if (searchParams.has(value)) {
                link += `${value}=${searchParams.get(value)}&`;
            }
        });

        let filter_category = $(this).val();
        window.location.href = `${pathName}?${link}filter_category=${filter_category}`;
    });

    $("#lfm").filemanager("image");

    $(".tags").tagsInput({
        defaultText: "",
        width: "100%",
    });

    $(".product-attr-tags").tagsInput({
        defaultText: "",
        width: "100%",
        delimiter: "$$",
    });

    $("#btn-generate-coupon").click(function (e) {
        e.preventDefault();
        let newCode = createRandomString(6);
        $("input[name='code']").val(newCode);
    });

    function createRandomString(length) {
        const chars =
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let result = "";
        for (let i = 0; i < length; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return result;
    }

    // Daterangpicker events
    $("#datepicker-coupon").daterangepicker({
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        startDate: $("#datepicker-coupon").data("start"),
        endDate: $("#datepicker-coupon").data("end"),
        locale: {
            format: "DD/MM/YYYY HH:mm:ss",
            separator: "-",
            applyLabel: "Apply",
            cancelLabel: "Cancel",
            fromLabel: "From",
            toLabel: "To",
            customRangeLabel: "Custom",
            weekLabel: "W",
            daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            monthNames: [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12",
            ],
            firstDay: 1,
        },
        opens: "center",
        drops: "auto",
    });

    $("#datepicker-coupon").on("apply.daterangepicker", function (ev, picker) {
        $('[name="start_time"]').val(
            picker.startDate.format("YYYY-MM-DD HH:mm:ss")
        );

        $('[name="end_time"]').val(
            picker.endDate.format("YYYY-MM-DD HH:mm:ss")
        );
    });
});
