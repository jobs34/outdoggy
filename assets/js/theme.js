"use strict";
var courseForm;
((function () {
    if (
        ($(".course-list, .scrollbar").length && $(".course-list, .scrollbar").slimScroll({ height: "100%" }),
        $(".nav-scroller").length && $(".nav-scroller").slimScroll({ height: "97%" }),
        $(".dropdown-menu a.dropdown-toggle").length &&
            $(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
                return (
                    $(this).next().hasClass("show") || $(this).parents(".dropdown-menu").first().find(".show").removeClass("show"),
                    $(this).next(".dropdown-menu").toggleClass("show"),
                    $(this)
                        .parents("li.nav-item.dropdown.show")
                        .on("hidden.bs.dropdown", function (e) {
                            $(".dropdown-submenu .show").removeClass("show");
                        }),
                    !1
                );
            }),
        $(".notification-list-scroll").length && $(".notification-list-scroll").slimScroll({ height: 300 }),
        $('[data-toggle="tooltip"]').length && $('[data-toggle="tooltip"]').tooltip(),
        $('[data-toggle="popover"]').length && $('[data-toggle="popover"]').popover(),
        $("#cardRadioone , #cardRadioTwo").length &&
            ($("#internetpayment").hide(),
            $("#cardRadioone").on("change", function () {
                this.checked && ($("#cardpayment").show(), $("#internetpayment").hide());
            }),
            $("#cardRadioTwo").on("change", function () {
                this.checked && ($("#internetpayment").show(), $("#cardpayment").hide());
            })),
        $(".popup-youtube").length && $(".popup-youtube").magnificPopup({ type: "iframe", mainClass: "mfp-fade", removalDelay: 160, preloader: !1, fixedContentPos: !0 }),
        $(".flatpickr").length && flatpickr(".flatpickr", { disableMobile: !0 }),
        $(".password-field input").length)
    ) {
        $(".password-field input").on("keyup", function () {
            var e = (function (e) {
                    var t = 0;
                    e.length >= 6 && (t += 1);
                    e.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/) && (t += 1);
                    e.match(/([a-zA-Z])/) && e.match(/([0-9])/) && (t += 1);
                    return t;
                })($(this).val()),
                t = $(this).parent(".password-field");
            t.removeClass(function (e, t) {
                return (t.match(/\level\S+/g) || []).join(" ");
            }),
                t.addClass("level" + e);
        });
    }
    if (($("input").length && Inputmask().mask(document.querySelectorAll("input")), $("#earning").length)) {
        var e = {
            series: [{ name: "Current Month", data: [10, 20, 15, 25, 18, 28, 22, 32, 24, 34, 26, 38] }],
            labels: ["Jan", "Feb", "March", "April", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            chart: { fontFamily: "$font-family-base", height: "280px", type: "line", toolbar: { show: !1 } },
            colors: ["#754FFE"],
            stroke: { width: 4, curve: "smooth", colors: ["#754FFE"] },
            xaxis: { axisBorder: { show: !1 }, axisTicks: { show: !1 }, crosshairs: { show: !0 }, labels: { offsetX: 0, offsetY: 5, style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" } } },
            yaxis: {
                labels: {
                    formatter: function (e) {
                        return e + "k";
                    },
                    style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" },
                    offsetX: -15,
                },
                tickAmount: 3,
                min: 10,
                max: 40,
            },
            grid: { borderColor: "#e0e6ed", strokeDashArray: 5, xaxis: { lines: { show: !1 } }, yaxis: { lines: { show: !0 } }, padding: { top: 0, right: 0, bottom: 0, left: 0 } },
            legend: {
                position: "top",
                horizontalAlign: "right",
                offsetY: -50,
                fontSize: "16px",
                markers: { width: 10, height: 10, strokeWidth: 0, strokeColor: "#fff", fillColors: void 0, radius: 12, onClick: void 0, offsetX: 0, offsetY: 0 },
                itemMargin: { horizontal: 0, vertical: 20 },
            },
            tooltip: { theme: "light", marker: { show: !0 }, x: { show: !1 } },
            responsive: [{ breakpoint: 575, options: { legend: { offsetY: -30 } } }],
        };
        new ApexCharts(document.querySelector("#earning"), e).render();
    }
    if ($("#earningTwo").length) {
        e = {
            series: [{ name: "Current Month", data: [10, 20, 15, 25, 18, 28, 22, 32, 24, 34, 26, 38] }],
            labels: ["Jan", "Feb", "March", "April", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            chart: { fontFamily: "$font-family-base", height: "280px", type: "line", toolbar: { show: !1 } },
            colors: ["#754FFE"],
            stroke: { width: 4, curve: "smooth", colors: ["#754FFE"] },
            xaxis: { axisBorder: { show: !1 }, axisTicks: { show: !1 }, crosshairs: { show: !0 }, labels: { offsetX: 0, offsetY: 5, style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" } } },
            yaxis: {
                labels: {
                    formatter: function (e) {
                        return e + "k";
                    },
                    style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" },
                    offsetX: -15,
                },
                tickAmount: 3,
                min: 10,
                max: 40,
            },
            grid: { borderColor: "#e0e6ed", strokeDashArray: 5, xaxis: { lines: { show: !1 } }, yaxis: { lines: { show: !0 } }, padding: { top: 0, right: 0, bottom: 0, left: 0 } },
            legend: {
                position: "top",
                horizontalAlign: "right",
                offsetY: -50,
                fontSize: "16px",
                markers: { width: 10, height: 10, strokeWidth: 0, strokeColor: "#fff", fillColors: void 0, radius: 12, onClick: void 0, offsetX: 0, offsetY: 0 },
                itemMargin: { horizontal: 0, vertical: 20 },
            },
            tooltip: { theme: "light", marker: { show: !0 }, x: { show: !1 } },
            responsive: [{ breakpoint: 575, options: { legend: { offsetY: -30 } } }],
        };
        new ApexCharts(document.querySelector("#earningTwo"), e).render();
    }
    if ($("#order").length) {
        e = {
            series: [{ name: "Days", data: [0, 3, 0.5, 3.5, 1, 2.5, 0.5, 4, 1.4, 4.5, 2.5, 4.8] }],
            labels: ["12 Jan", "14 Jan", "16 Jan", "18 Jan", "20 Jan", "22 Jan", "24 Jan", "26 Jan", "27 Jan", "28 Jan", "29 Jan", "30 Jan"],
            chart: { fontFamily: "$font-family-base", height: "280px", type: "line", toolbar: { show: !1 } },
            colors: ["#754FFE"],
            stroke: { width: 4, curve: "smooth", colors: ["#754FFE"] },
            xaxis: { axisBorder: { show: !1 }, axisTicks: { show: !1 }, crosshairs: { show: !0 }, labels: { offsetX: 0, offsetY: 5, style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" } } },
            yaxis: {
                labels: {
                    formatter: function (e, t) {
                        return e.toFixed(0);
                    },
                    style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" },
                    offsetX: -20,
                },
                tickAmount: 3,
                min: 0,
                max: 5,
            },
            grid: { borderColor: "#e0e6ed", strokeDashArray: 5, xaxis: { lines: { show: !1 } }, yaxis: { lines: { show: !0 } }, padding: { top: 0, right: 0, bottom: 0, left: -10 } },
            legend: {
                position: "top",
                horizontalAlign: "right",
                offsetY: -50,
                fontSize: "16px",
                markers: { width: 10, height: 10, strokeWidth: 0, strokeColor: "#fff", fillColors: void 0, radius: 12, onClick: void 0, offsetX: 0, offsetY: 0 },
                itemMargin: { horizontal: 0, vertical: 20 },
            },
            tooltip: { theme: "light", marker: { show: !0 }, x: { show: !1 } },
            responsive: [{ breakpoint: 575, options: { legend: { offsetY: -30 } } }],
        };
        new ApexCharts(document.querySelector("#order"), e).render();
    }
    if ($("#traffic").length) {
        e = {
            dataLabels: { enabled: !1 },
            series: [44, 55, 41],
            labels: ["Direct", "Referral", "Organic"],
            colors: ["#754FFE", "#CEC0FF", "#E8E2FF"],
            chart: { width: 392, type: "donut" },
            plotOptions: { pie: { expandOnClick: !1, donut: { size: "78%" } } },
            legend: {
                position: "bottom",
                fontFamily: "inter",
                fontWeight: 500,
                fontSize: "14px",
                markers: { width: 8, height: 8, strokeWidth: 0, strokeColor: "#fff", fillColors: void 0, radius: 12, customHTML: void 0, onClick: void 0, offsetX: 0, offsetY: 0 },
                itemMargin: { horizontal: 8, vertical: 0 },
            },
            tooltip: { theme: "light", marker: { show: !0 }, x: { show: !1 } },
            states: { hover: { filter: { type: "none" } } },
        };
        new ApexCharts(document.querySelector("#traffic"), e).render();
    }
    if ($("#orderColumn").length) {
        e = {
            series: [{ data: [4, 6, 5, 3, 5, 6, 8, 9] }],
            chart: { toolbar: { show: !1 }, type: "bar", height: 272 },
            colors: ["#754FFE"],
            plotOptions: { bar: { horizontal: !1, columnWidth: "12%", endingShape: "rounded" } },
            dataLabels: { enabled: !1 },
            stroke: { show: !0, width: 1, colors: ["transparent"] },
            grid: { borderColor: "#e0e6ed", strokeDashArray: 5, xaxis: { lines: { show: !1 } } },
            xaxis: {
                categories: ["1 Jun", "9 Jun", "16 jun", "18 Jun", "19 Jun", "22 jun", "24 Jun", "26 Jun"],
                axisBorder: { show: !1 },
                labels: { offsetX: 0, offsetY: 5, style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" } },
            },
            grid: { borderColor: "#e0e6ed", strokeDashArray: 5, xaxis: { lines: { show: !1 } }, yaxis: { lines: { show: !0 } }, padding: { top: 0, right: 0, bottom: 0, left: -10 } },
            yaxis: { title: { text: void 0 }, plotOptions: { bar: { horizontal: !1, endingShape: "rounded", columnWidth: "80%" } }, labels: { style: { fontSize: "13px", fontWeight: 400, colors: "#a8a3b9" }, offsetX: -10 } },
            fill: { opacity: 1 },
            tooltip: {
                y: {
                    formatter: function (e) {
                        return e + " sales ";
                    },
                },
                marker: { show: !0 },
            },
        };
        new ApexCharts(document.querySelector("#orderColumn"), e).render();
    }
    if ($("#totalEarning").length) {
        e = {
            series: [{ data: [50, 80, 5, 90, 12, 150, 12, 80, 150] }],
            chart: { width: 130, type: "line", toolbar: { show: !1 } },
            tooltip: { enabled: !1 },
            stroke: { show: !0, curve: "smooth", lineCap: "butt", colors: ["#19cb98"], width: 2, dashArray: 0 },
            grid: { show: !1 },
            yaxis: { labels: { show: !1 } },
            xaxis: { axisBorder: { show: !1 }, labels: { show: !1 }, categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"] },
        };
        new ApexCharts(document.querySelector("#totalEarning"), e).render();
    }
    if ($("#payoutChart").length) {
        e = {
            series: [{ name: "Inflation", data: [40, 20, 50, 80, 65] }],
            chart: { height: 150, type: "bar", toolbar: { show: !1 } },
            colors: ["#E8E2FF"],
            grid: { show: !1 },
            tooltip: { enabled: !1 },
            plotOptions: { bar: { endingShape: "flat", columnWidth: "65%" } },
            dataLabels: { enabled: !1 },
            xaxis: {
                labels: { show: !1 },
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: "top",
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                crosshairs: { fill: { type: "gradient", gradient: { colorFrom: "#D8E3F0", colorTo: "#BED1E6", stops: [0, 100], opacityFrom: 0.4, opacityTo: 0.5 } } },
                tooltip: { enabled: !0 },
            },
            yaxis: { show: !1 },
        };
        new ApexCharts(document.querySelector("#payoutChart"), e).render();
    }
    if ($("#editor").length) new Quill("#editor", { theme: "snow" });
    if ($("#courseCoverImg").length) new FileUploadWithPreview("courseCoverImg", { showDeleteButtonOnImages: !0, text: { chooseFile: " No File Selected", browse: "Upload File" } });
    if (
        ($("#nav-toggle").length &&
            $("#nav-toggle").on("click", function (e) {
                e.preventDefault(), $("#db-wrapper").toggleClass("toggled");
            }),
        $("#invoice").length &&
            $("#invoice")
                .find(".print-link")
                .on("click", function () {
                    $.print("#invoice");
                }),
        $(".sidebar-nav-fixed a").length &&
            $(".sidebar-nav-fixed a").on("click", function (e) {
                if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                    var t = $(this.hash);
                    (t = t.length ? t : $("[name=" + this.hash.slice(1) + "]")).length &&
                        (e.preventDefault(),
                        $("html, body").animate({ scrollTop: t.offset().top - 90 }, 1e3, function () {
                            var e = $(t);
                            if ((e.focus(), e.is(":focus"))) return !1;
                            e.attr("tabindex", "-1"), e.focus();
                        }));
                }
                $(".sidebar-nav-fixed a").each(function () {
                    $(this).removeClass("active");
                }),
                    $(this).addClass("active");
            }),
        $("#checkAll").length &&
            $("#checkAll").on("click", function () {
                $("input:checkbox").not(this).prop("checked", this.checked);
            }),
        $("#btn-icon").length &&
            $(".btn-icon").on("click", function () {
                $(this).parent().addClass("active").siblings().removeClass("active");
            }),
        $(".stopevent").length &&
            $(document).on("click.bs.dropdown.data-api", ".stopevent", function (e) {
                e.stopPropagation();
            }),
        $("input[name=tags]").length)
    ) {
        var t = document.querySelector("input[name=tags]");
        new Tagify(t);
    }
    if ($(".headingTyped").length) new Typed(".headingTyped", { strings: ["Skills", "Products ", "Teams", "Future"], typeSpeed: 40, backSpeed: 40, backDelay: 1e3, loop: !0 });
})(),
(function () {
    var e = $("#pricing-switch input");
    $(e).on("change", function () {
        !0 === $(e).is(":checked")
            ? $(".toggle-price-content").each(function () {
                  $(this).html($(this).data("price-yearly"));
              })
            : $(".toggle-price-content").each(function () {
                  $(this).html($(this).data("price-monthly"));
              });
    });
})(),
dragula([document.querySelector("#courseOne"), document.querySelector("#courseTwo")]),
$("#courseForm").length) &&
    document.addEventListener("DOMContentLoaded", function () {
        courseForm = new Stepper(document.querySelector("#courseForm"), { linear: !1, animation: !0 });
    });
!(function () {
    for (var e = document.getElementsByTagName("pre"), t = 0; t < e.length; t++) {
        if (0 === e[t].children[0].className.indexOf("language-")) {
            var o = document.createElement("button");
            (o.className = "copy-button"), (o.textContent = "Copy"), e[t].appendChild(o);
        }
    }
    
    
    
})(),
    (function () {
        var e = window.location + "",
            t = e.replace(window.location.protocol + "//" + window.location.host + "/", "");
        $("ul#sidebarnav a")
            .filter(function () {
                return this.href === e || this.href === t;
            })
            .parentsUntil(".sidebar-nav")
            .each(function (e) {
                $(this).is("li") && 0 !== $(this).children("a").length
                    ? ($(this).children("a").addClass("active"), $(this).parent("ul#sidebarnav").length, $(this).addClass("active"))
                    : $(this).is("ul") || 0 !== $(this).children("a").length
                    ? $(this).is("ul") && $(this).addClass("in")
                    : $(this).addClass("active");
            });
    })(),
    (function () {
        if ($(".sliderFirst").length)
            tns({
                container: ".sliderFirst",
                loop: !1,
                startIndex: 1,
                items: 1,
                nav: !1,
                autoplay: !0,
                swipeAngle: !1,
                speed: 400,
                autoplayButtonOutput: !1,
                mouseDrag: !0,
                lazyload: !0,
                gutter: 20,
                controlsContainer: "#sliderFirstControls",
                responsive: { 768: { items: 2 }, 990: { items: 4 } },
            });
        if ($(".sliderSecond").length)
            tns({
                container: ".sliderSecond",
                loop: !1,
                startIndex: 1,
                items: 1,
                nav: !1,
                autoplay: !0,
                swipeAngle: !1,
                speed: 400,
                autoplayButtonOutput: !1,
                mouseDrag: !0,
                lazyload: !0,
                gutter: 20,
                controlsContainer: "#sliderSecondControls",
                responsive: { 768: { items: 2 }, 990: { items: 4 } },
            });
        if ($(".sliderThird").length)
            tns({
                container: ".sliderThird",
                loop: !1,
                startIndex: 1,
                items: 1,
                nav: !1,
                autoplay: !0,
                swipeAngle: !1,
                speed: 400,
                autoplayButtonOutput: !1,
                mouseDrag: !0,
                lazyload: !0,
                gutter: 20,
                controlsContainer: "#sliderThirdControls",
                responsive: { 768: { items: 2 }, 990: { items: 4 } },
            });
        if ($(".sliderFourth").length)
            tns({
                container: ".sliderFourth",
                loop: !1,
                startIndex: 1,
                items: 1,
                nav: !1,
                autoplay: !0,
                swipeAngle: !1,
                speed: 400,
                autoplayButtonOutput: !1,
                mouseDrag: !0,
                lazyload: !0,
                gutter: 20,
                controlsContainer: "#sliderFourthControls",
                responsive: { 768: { items: 2 }, 990: { items: 4 } },
            });
        if ($(".sliderTestimonial").length)
            tns({
                container: ".sliderTestimonial",
                loop: !1,
                startIndex: 1,
                items: 1,
                nav: !1,
                autoplay: !0,
                swipeAngle: !1,
                speed: 400,
                autoplayButtonOutput: !1,
                mouseDrag: !0,
                lazyload: !0,
                gutter: 20,
                controlsContainer: "#sliderTestimonialControls",
                responsive: { 768: { items: 2 }, 990: { items: 3 } },
            });
    })(),
    
    $(".contacts-list .contacts-link").on("click", function () {
        $(".chat-body").addClass("chat-body-visible");
    }),
    $("[data-close]").on("click", function (e) {
        e.preventDefault(), $(".chat-body").removeClass("chat-body-visible");
    }),
    (function (e) {
        e.fn.downCount = function (t, o) {
            var n = e.extend({ date: null, offset: null }, t);
            n.date || e.error("Date is not defined."), Date.parse(n.date) || e.error("Incorrect date format, it should look like this, 12/24/2012 12:00:00.");
            var a = this,
                i = function () {
                    var e = new Date(),
                        t = e.getTime() + 6e4 * e.getTimezoneOffset();
                    return new Date(t + 36e5 * n.offset);
                },
                r = setInterval(function () {
                    var e = new Date(n.date) - i();
                    if (0 > e) return clearInterval(r), void (o && "function" == typeof o && o());
                    var t = 6e4,
                        s = 60 * t,
                        l = 24 * s,
                        d = Math.floor(e / l),
                        h = Math.floor((e % l) / s),
                        c = Math.floor((e % s) / t),
                        f = Math.floor((e % t) / 1e3),
                        p = 1 === (d = String(d).length >= 2 ? d : "0" + d) ? "day" : "days",
                        u = 1 === (h = String(h).length >= 2 ? h : "0" + h) ? "hour" : "hours",
                        g = 1 === (c = String(c).length >= 2 ? c : "0" + c) ? "minute" : "minutes",
                        m = 1 === (f = String(f).length >= 2 ? f : "0" + f) ? "second" : "seconds";
                    a.find(".days").text(d),
                        a.find(".hours").text(h),
                        a.find(".minutes").text(c),
                        a.find(".seconds").text(f),
                        a.find(".days_ref").text(p),
                        a.find(".hours_ref").text(u),
                        a.find(".minutes_ref").text(g),
                        a.find(".seconds_ref").text(m);
                }, 1e3);
        };
    })(jQuery),
    $(".countdown").downCount({
        date: (function () {
            var e = new Date();
            e.setDate(e.getDate() + 99);
            var t = e.getDate();
            return e.getMonth() + 1 + "/" + t + "/" + e.getFullYear() + " 12:00:00";
        })(),
        offset: 0,
    }),
    (function () {
        if ($("#userChart").length) {
            var e = {
                chart: { height: 60, type: "area", toolbar: { show: !1 }, sparkline: { enabled: !0 }, grid: { show: !1, padding: { left: 0, right: 0 } } },
                dataLabels: { enabled: !1 },
                stroke: { curve: "smooth", width: 2 },
                fill: { type: "gradient", gradient: { shadeIntensity: 0.9, opacityFrom: 0.7, opacityTo: 0.5, stops: [0, 80, 100] } },
                series: [{ name: "User", data: [28, 40, 36, 52, 38, 60, 55] }],
                xaxis: { labels: { show: !1 }, axisBorder: { show: !1 } },
                yaxis: [{ y: 0, offsetX: 0, offsetY: 0, padding: { left: 0, right: 0 } }],
                tooltip: { x: { show: !1 } },
            };
            new ApexCharts(document.querySelector("#userChart"), e).render();
        }
        if ($("#userChartExample").length) {
            e = {
                chart: { height: 60, type: "area", toolbar: { show: !1 }, sparkline: { enabled: !0 }, grid: { show: !1, padding: { left: 0, right: 0 } } },
                colors: ["#e53f3c"],
                dataLabels: { enabled: !1 },
                stroke: { curve: "smooth", width: 2 },
                fill: { type: "gradient", gradient: { shadeIntensity: 0.9, opacityFrom: 0.7, opacityTo: 0.5, stops: [0, 80, 100] } },
                series: [{ name: "User", data: [28, 40, 36, 52, 38, 60, 55] }],
                xaxis: { labels: { show: !1 }, axisBorder: { show: !1 } },
                yaxis: [{ y: 0, offsetX: 0, offsetY: 0, padding: { left: 0, right: 0 } }],
                tooltip: { x: { show: !1 } },
            };
            new ApexCharts(document.querySelector("#userChartExample"), e).render();
        }
        if ($("#userChart").length) {
            e = {
                chart: { height: 60, type: "area", toolbar: { show: !1 }, sparkline: { enabled: !0 }, grid: { show: !1, padding: { left: 0, right: 0 } } },
                colors: ["#19cb98"],
                dataLabels: { enabled: !1 },
                stroke: { curve: "smooth", width: 2 },
                fill: { colors: "#19cb98", type: "gradient", gradient: { type: "vertical", shadeIntensity: 0.9, opacityFrom: 0.7, opacityTo: 0.5, stops: [0, 100] } },
                series: [{ name: "User", data: [28, 40, 36, 52, 38, 60, 55] }],
                xaxis: { labels: { show: !1 }, axisBorder: { show: !1 } },
                yaxis: [{ y: 0, offsetX: 0, offsetY: 0, padding: { left: 0, right: 0 } }],
                tooltip: { x: { show: !1 } },
            };
            new ApexCharts(document.querySelector("#visitorChart"), e).render();
        }
        if ($("#bounceChart").length) {
            e = {
                chart: { height: 60, type: "line", toolbar: { show: !1 }, sparkline: { enabled: !0 }, grid: { show: !1, padding: { left: 0, right: 0 } } },
                colors: ["#c28135"],
                dataLabels: { enabled: !1 },
                stroke: { curve: "straight", width: 4 },
                markers: { size: 4, hover: { size: 6, sizeOffset: 3 } },
                series: [{ name: "Bonus Rate", data: [28, 40, 36, 52, 38, 60, 55] }],
                xaxis: { labels: { show: !1 }, axisBorder: { show: !1 } },
                yaxis: [{ y: 0, offsetX: 0, offsetY: 0, padding: { left: 0, right: 0 } }],
                tooltip: { x: { show: !1 } },
            };
            new ApexCharts(document.querySelector("#bounceChart"), e).render();
        }
        if ($("#sessionChart").length) {
            e = {
                series: [
                    { name: "Session Duration", data: [600, 1e3, 400, 2e3, 500, 900, 2500, 1800, 3800], colors: ["#754ffe"] },
                    { name: "Page Views", data: [1e3, 2e3, 800, 1200, 300, 1900, 1600, 2e3, 1e3] },
                    { name: "Total Visits", data: [2200, 1e3, 3400, 900, 500, 2500, 3e3, 1e3, 2500] },
                ],
                chart: {
                    animations: { enabled: !0, easing: "easeinout", speed: 800, animateGradually: { enabled: !0, delay: 500 }, dynamicAnimation: { enabled: !0, speed: 350 } },
                    toolbar: { show: !1 },
                    height: 400,
                    type: "line",
                    zoom: { enabled: !1 },
                },
                dataLabels: { enabled: !1 },
                stroke: { width: [4, 3, 3], curve: "smooth", dashArray: [0, 5, 4] },
                legend: { show: !1 },
                colors: ["#754ffe", "#19cb98", "#ffaa46"],
                markers: { size: 0, hover: { sizeOffset: 6 } },
                xaxis: {
                    categories: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan", "09 Jan", "10 Jan", "11 Jan", "12 Jan"],
                    labels: { style: { colors: ["#5c5776"], fontSize: "12px", fontFamily: "Inter", cssClass: "apexcharts-xaxis-label" } },
                },
                yaxis: { labels: { style: { colors: ["#5c5776"], fontSize: "12px", fontFamily: "Inter", cssClass: "apexcharts-xaxis-label" }, offsetX: -12, offsetY: 0 } },
                tooltip: {
                    y: [
                        {
                            title: {
                                formatter: function (e) {
                                    return e + " (mins)";
                                },
                            },
                        },
                        {
                            title: {
                                formatter: function (e) {
                                    return e + " per session";
                                },
                            },
                        },
                        {
                            title: {
                                formatter: function (e) {
                                    return e;
                                },
                            },
                        },
                    ],
                },
                grid: { borderColor: "#f1f1f1" },
            };
            new ApexCharts(document.querySelector("#sessionChart"), e).render();
        }
        if ($("#support-chart1").length) {
            e = {
                chart: { type: "bar", height: 302, sparkline: { enabled: !0 } },
                states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "darken", value: 0.55 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "darken", value: 0.55 } } },
                colors: ["#8968fe"],
                plotOptions: { bar: { borderRadius: 4, columnWidth: "50%" } },
                series: [{ data: [25, 66, 41, 70, 63, 25, 44, 22, 36, 19, 54, 44, 32, 36, 29, 54, 25, 66, 41, 65, 63, 25, 44, 12, 36, 39, 25, 44, 42, 36, 54] }],
                xaxis: { crosshairs: { width: 1 } },
                tooltip: {
                    fixed: { enabled: !1 },
                    x: { show: !1 },
                    y: {
                        title: {
                            formatter: function (e) {
                                return "Active User";
                            },
                        },
                    },
                    marker: { show: !1 },
                },
            };
            new ApexCharts(document.querySelector("#support-chart1"), e).render();
        }
        if ($("#locationmap").length) {
            new jsVectorMap({
                map: "world",
                selector: "#locationmap",
                zoomOnScroll: !0,
                zoomButtons: !0,
                markersSelectable: !0,
                markers: [
                    { name: "United Kingdom", coords: [53.613, -11.6368] },
                    { name: "India", coords: [20.7504374, 73.7276105] },
                    { name: "United States", coords: [37.2580397, -104.657039] },
                    { name: "Australia", coords: [-25.0304388, 115.2092761] },
                ],
                markerStyle: { initial: { fill: "#754FFE" } },
                markerLabelStyle: { initial: { fontFamily: "Inter", fontSize: 13, fontWeight: 500, cursor: "default", fill: "#18113C" } },
                labels: { markers: { render: (e) => e.name } },
            });
        }
        if ($("#trafficDountChart").length) {
            e = {
                series: [60, 55, 12, 17],
                labels: ["Organic Search", "Direct", "Refferrals", "Social Media"],
                colors: ["#754FFE", "#19cb98", "#e53f3c", "#ffaa46"],
                chart: { type: "donut", height: 260 },
                legend: { show: !1 },
                dataLabels: { enabled: !1 },
                plotOptions: { pie: { donut: { size: "50%" } } },
                stroke: { width: 2 },
            };
            new ApexCharts(document.querySelector("#trafficDountChart"), e).render();
        }
        if ($("#operatingSystem").length) {
            e = {
                series: [55, 88, 80, 75],
                labels: ["Window", "macOS", "Linux", "Android"],
                chart: { type: "polarArea", height: 350 },
                colors: ["#e53f3c", "#19cb98", "#754FFE", "#29BAF9"],
                legend: { show: !1 },
                stroke: { colors: ["#fff"] },
                fill: { opacity: 0.9 },
            };
            new ApexCharts(document.querySelector("#operatingSystem"), e).render();
        }
    })();
