(function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function (e, t) {
    (t.defineLocale || t.lang).call(t, "est", {
        months: "jaanuar_veebruar_märts_aprill_mai_juuni_juuli_august_september_oktoober_november_detsember".split("_"),
        monthsShort: "jaan_veebr_märts_apr_mai_juuni_juuli_aug_sept_okt_nov_dets".split("_"),
        weekdays: "pühapäev_esmaspäev_teisipäev_kolmapäev_neljapäev_reede_laupäev".split("_"),
        weekdaysShort: "P_E_T_K_N_R_L".split("_"),
        weekdaysMin: "P_E_T_K_N_R_L".split("_"),
        longDateFormat: {
            LT: "HH:mm",
            L: "DD/MM/YYYY",
            LL: "D MMMM YYYY",
            LLL: "D MMMM YYYY LT",
            LLLL: "dddd, D MMMM YYYY LT"
        },
        calendar: {
            sameDay: "[Täna kell] LT",
            nextDay: "[Homme kell] LT",
            nextWeek: "dddd [at] LT",
            lastDay: "[Eile kell] LT",
            lastWeek: "[Eelmine] dddd [at] LT",
            sameElse: "L"},
        relativeTime: {
            future: "in %s",
            past: "%s ago",
            s: "a few seconds",
            m: "a minute",
            mm: "%d minutes",
            h: "an hour",
            hh: "%d hours",
            d: "a day",
            dd: "%d days",
            M: "a month",
            MM: "%d months",
            y: "a year",
            yy: "%d years"
        },
        ordinal: function (e) {
        var t = e % 10, n = 1 === ~~(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th";
        return e + n
    }, week: {
            dow: 1,
            doy: 4
        }}),
        e.fullCalendar.datepickerLang("est","est", {
            closeText: "Valmis",
            prevText: "Eelmine",
            nextText: "Järgmine",
            currentText: "Täna",
            monthNames: ["jaanuar_veebruar_märts_aprill_mai_juuni_juuli_august_september_oktoober_november_detsember"],
            monthNamesShort: ["jaan_veebr_märts_apr_mai_juuni_juuli_aug_sept_okt_nov_dets"],
            dayNames: ["pühapäev_esmaspäev_teisipäev_kolmapäev_neljapäev_reede_laupäev"],
            dayNamesShort: ["P_E_T_K_N_R_L"],
            dayNamesMin: ["P_E_T_K_N_R_L"],
            weekHeader: "Nädal",
            dateFormat: "dd/mm/yy",
            firstDay: 1, isRTL: !1, showMonthAfterYear: !1, yearSuffix: ""
        }),
        e.fullCalendar.lang("est", {
            columnFormat: {
                week: "ddd D/M"
            }
        })
});