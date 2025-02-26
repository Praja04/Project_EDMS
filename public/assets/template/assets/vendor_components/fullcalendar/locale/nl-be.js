!(function (e, n) {
  "object" == typeof exports && "object" == typeof module
    ? (module.exports = n(require("moment"), require("fullcalendar")))
    : "function" == typeof define && define.amd
      ? define(["moment", "fullcalendar"], n)
      : "object" == typeof exports
        ? n(require("moment"), require("fullcalendar"))
        : n(e.moment, e.FullCalendar);
})("undefined" != typeof self ? self : this, function (e, n) {
  return (function (e) {
    function n(t) {
      if (a[t]) return a[t].exports;
      var r = (a[t] = { i: t, l: !1, exports: {} });
      return e[t].call(r.exports, r, r.exports, n), (r.l = !0), r.exports;
    }
    var a = {};
    return (
      (n.m = e),
      (n.c = a),
      (n.d = function (e, a, t) {
        n.o(e, a) ||
          Object.defineProperty(e, a, {
            configurable: !1,
            enumerable: !0,
            get: t,
          });
      }),
      (n.n = function (e) {
        var a =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return n.d(a, "a", a), a;
      }),
      (n.o = function (e, n) {
        return Object.prototype.hasOwnProperty.call(e, n);
      }),
      (n.p = ""),
      n((n.s = 167))
    );
  })({
    0: function (n, a) {
      n.exports = e;
    },
    1: function (e, a) {
      e.exports = n;
    },
    167: function (e, n, a) {
      Object.defineProperty(n, "__esModule", { value: !0 }), a(168);
      var t = a(1);
      t.datepickerLocale("nl-be", "nl-BE", {
        closeText: "Sluiten",
        prevText: "←",
        nextText: "→",
        currentText: "Vandaag",
        monthNames: [
          "januari",
          "februari",
          "maart",
          "april",
          "mei",
          "juni",
          "juli",
          "augustus",
          "september",
          "oktober",
          "november",
          "december",
        ],
        monthNamesShort: [
          "jan",
          "feb",
          "mrt",
          "apr",
          "mei",
          "jun",
          "jul",
          "aug",
          "sep",
          "okt",
          "nov",
          "dec",
        ],
        dayNames: [
          "zondag",
          "maandag",
          "dinsdag",
          "woensdag",
          "donderdag",
          "vrijdag",
          "zaterdag",
        ],
        dayNamesShort: ["zon", "maa", "din", "woe", "don", "vri", "zat"],
        dayNamesMin: ["zo", "ma", "di", "wo", "do", "vr", "za"],
        weekHeader: "Wk",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: !1,
        showMonthAfterYear: !1,
        yearSuffix: "",
      }),
        t.locale("nl-be", {
          buttonText: {
            month: "Maand",
            week: "Week",
            day: "Dag",
            list: "Agenda",
          },
          allDayText: "Hele dag",
          eventLimitText: "extra",
          noEventsMessage: "Geen evenementen om te laten zien",
        });
    },
    168: function (e, n, a) {
      !(function (e, n) {
        n(a(0));
      })(0, function (e) {
        var n =
            "jan._feb._mrt._apr._mei_jun._jul._aug._sep._okt._nov._dec.".split(
              "_",
            ),
          a = "jan_feb_mrt_apr_mei_jun_jul_aug_sep_okt_nov_dec".split("_"),
          t = [
            /^jan/i,
            /^feb/i,
            /^maart|mrt.?$/i,
            /^apr/i,
            /^mei$/i,
            /^jun[i.]?$/i,
            /^jul[i.]?$/i,
            /^aug/i,
            /^sep/i,
            /^okt/i,
            /^nov/i,
            /^dec/i,
          ],
          r =
            /^(januari|februari|maart|april|mei|april|ju[nl]i|augustus|september|oktober|november|december|jan\.?|feb\.?|mrt\.?|apr\.?|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i;
        return e.defineLocale("nl-be", {
          months:
            "januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december".split(
              "_",
            ),
          monthsShort: function (e, t) {
            return e ? (/-MMM-/.test(t) ? a[e.month()] : n[e.month()]) : n;
          },
          monthsRegex: r,
          monthsShortRegex: r,
          monthsStrictRegex:
            /^(januari|februari|maart|mei|ju[nl]i|april|augustus|september|oktober|november|december)/i,
          monthsShortStrictRegex:
            /^(jan\.?|feb\.?|mrt\.?|apr\.?|mei|ju[nl]\.?|aug\.?|sep\.?|okt\.?|nov\.?|dec\.?)/i,
          monthsParse: t,
          longMonthsParse: t,
          shortMonthsParse: t,
          weekdays:
            "zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag".split(
              "_",
            ),
          weekdaysShort: "zo._ma._di._wo._do._vr._za.".split("_"),
          weekdaysMin: "zo_ma_di_wo_do_vr_za".split("_"),
          weekdaysParseExact: !0,
          longDateFormat: {
            LT: "HH:mm",
            LTS: "HH:mm:ss",
            L: "DD/MM/YYYY",
            LL: "D MMMM YYYY",
            LLL: "D MMMM YYYY HH:mm",
            LLLL: "dddd D MMMM YYYY HH:mm",
          },
          calendar: {
            sameDay: "[vandaag om] LT",
            nextDay: "[morgen om] LT",
            nextWeek: "dddd [om] LT",
            lastDay: "[gisteren om] LT",
            lastWeek: "[afgelopen] dddd [om] LT",
            sameElse: "L",
          },
          relativeTime: {
            future: "over %s",
            past: "%s geleden",
            s: "een paar seconden",
            ss: "%d seconden",
            m: "één minuut",
            mm: "%d minuten",
            h: "één uur",
            hh: "%d uur",
            d: "één dag",
            dd: "%d dagen",
            M: "één maand",
            MM: "%d maanden",
            y: "één jaar",
            yy: "%d jaar",
          },
          dayOfMonthOrdinalParse: /\d{1,2}(ste|de)/,
          ordinal: function (e) {
            return e + (1 === e || 8 === e || e >= 20 ? "ste" : "de");
          },
          week: { dow: 1, doy: 4 },
        });
      });
    },
  });
});
