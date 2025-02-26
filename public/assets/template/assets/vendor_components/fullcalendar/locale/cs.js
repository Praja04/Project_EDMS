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
    function n(r) {
      if (t[r]) return t[r].exports;
      var s = (t[r] = { i: r, l: !1, exports: {} });
      return e[r].call(s.exports, s, s.exports, n), (s.l = !0), s.exports;
    }
    var t = {};
    return (
      (n.m = e),
      (n.c = t),
      (n.d = function (e, t, r) {
        n.o(e, t) ||
          Object.defineProperty(e, t, {
            configurable: !1,
            enumerable: !0,
            get: r,
          });
      }),
      (n.n = function (e) {
        var t =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return n.d(t, "a", t), t;
      }),
      (n.o = function (e, n) {
        return Object.prototype.hasOwnProperty.call(e, n);
      }),
      (n.p = ""),
      n((n.s = 87))
    );
  })({
    0: function (n, t) {
      n.exports = e;
    },
    1: function (e, t) {
      e.exports = n;
    },
    87: function (e, n, t) {
      Object.defineProperty(n, "__esModule", { value: !0 }), t(88);
      var r = t(1);
      r.datepickerLocale("cs", "cs", {
        closeText: "Zavřít",
        prevText: "&#x3C;Dříve",
        nextText: "Později&#x3E;",
        currentText: "Nyní",
        monthNames: [
          "leden",
          "únor",
          "březen",
          "duben",
          "květen",
          "červen",
          "červenec",
          "srpen",
          "září",
          "říjen",
          "listopad",
          "prosinec",
        ],
        monthNamesShort: [
          "led",
          "úno",
          "bře",
          "dub",
          "kvě",
          "čer",
          "čvc",
          "srp",
          "zář",
          "říj",
          "lis",
          "pro",
        ],
        dayNames: [
          "neděle",
          "pondělí",
          "úterý",
          "středa",
          "čtvrtek",
          "pátek",
          "sobota",
        ],
        dayNamesShort: ["ne", "po", "út", "st", "čt", "pá", "so"],
        dayNamesMin: ["ne", "po", "út", "st", "čt", "pá", "so"],
        weekHeader: "Týd",
        dateFormat: "dd.mm.yy",
        firstDay: 1,
        isRTL: !1,
        showMonthAfterYear: !1,
        yearSuffix: "",
      }),
        r.locale("cs", {
          buttonText: {
            month: "Měsíc",
            week: "Týden",
            day: "Den",
            list: "Agenda",
          },
          allDayText: "Celý den",
          eventLimitText: function (e) {
            return "+další: " + e;
          },
          noEventsMessage: "Žádné akce k zobrazení",
        });
    },
    88: function (e, n, t) {
      !(function (e, n) {
        n(t(0));
      })(0, function (e) {
        function n(e) {
          return e > 1 && e < 5 && 1 != ~~(e / 10);
        }
        function t(e, t, r, s) {
          var o = e + " ";
          switch (r) {
            case "s":
              return t || s ? "pár sekund" : "pár sekundami";
            case "ss":
              return t || s
                ? o + (n(e) ? "sekundy" : "sekund")
                : o + "sekundami";
            case "m":
              return t ? "minuta" : s ? "minutu" : "minutou";
            case "mm":
              return t || s ? o + (n(e) ? "minuty" : "minut") : o + "minutami";
            case "h":
              return t ? "hodina" : s ? "hodinu" : "hodinou";
            case "hh":
              return t || s ? o + (n(e) ? "hodiny" : "hodin") : o + "hodinami";
            case "d":
              return t || s ? "den" : "dnem";
            case "dd":
              return t || s ? o + (n(e) ? "dny" : "dní") : o + "dny";
            case "M":
              return t || s ? "měsíc" : "měsícem";
            case "MM":
              return t || s ? o + (n(e) ? "měsíce" : "měsíců") : o + "měsíci";
            case "y":
              return t || s ? "rok" : "rokem";
            case "yy":
              return t || s ? o + (n(e) ? "roky" : "let") : o + "lety";
          }
        }
        var r =
            "leden_únor_březen_duben_květen_červen_červenec_srpen_září_říjen_listopad_prosinec".split(
              "_",
            ),
          s = "led_úno_bře_dub_kvě_čvn_čvc_srp_zář_říj_lis_pro".split("_");
        return e.defineLocale("cs", {
          months: r,
          monthsShort: s,
          monthsParse: (function (e, n) {
            var t,
              r = [];
            for (t = 0; t < 12; t++)
              r[t] = new RegExp("^" + e[t] + "$|^" + n[t] + "$", "i");
            return r;
          })(r, s),
          shortMonthsParse: (function (e) {
            var n,
              t = [];
            for (n = 0; n < 12; n++) t[n] = new RegExp("^" + e[n] + "$", "i");
            return t;
          })(s),
          longMonthsParse: (function (e) {
            var n,
              t = [];
            for (n = 0; n < 12; n++) t[n] = new RegExp("^" + e[n] + "$", "i");
            return t;
          })(r),
          weekdays: "neděle_pondělí_úterý_středa_čtvrtek_pátek_sobota".split(
            "_",
          ),
          weekdaysShort: "ne_po_út_st_čt_pá_so".split("_"),
          weekdaysMin: "ne_po_út_st_čt_pá_so".split("_"),
          longDateFormat: {
            LT: "H:mm",
            LTS: "H:mm:ss",
            L: "DD.MM.YYYY",
            LL: "D. MMMM YYYY",
            LLL: "D. MMMM YYYY H:mm",
            LLLL: "dddd D. MMMM YYYY H:mm",
            l: "D. M. YYYY",
          },
          calendar: {
            sameDay: "[dnes v] LT",
            nextDay: "[zítra v] LT",
            nextWeek: function () {
              switch (this.day()) {
                case 0:
                  return "[v neděli v] LT";
                case 1:
                case 2:
                  return "[v] dddd [v] LT";
                case 3:
                  return "[ve středu v] LT";
                case 4:
                  return "[ve čtvrtek v] LT";
                case 5:
                  return "[v pátek v] LT";
                case 6:
                  return "[v sobotu v] LT";
              }
            },
            lastDay: "[včera v] LT",
            lastWeek: function () {
              switch (this.day()) {
                case 0:
                  return "[minulou neděli v] LT";
                case 1:
                case 2:
                  return "[minulé] dddd [v] LT";
                case 3:
                  return "[minulou středu v] LT";
                case 4:
                case 5:
                  return "[minulý] dddd [v] LT";
                case 6:
                  return "[minulou sobotu v] LT";
              }
            },
            sameElse: "L",
          },
          relativeTime: {
            future: "za %s",
            past: "před %s",
            s: t,
            ss: t,
            m: t,
            mm: t,
            h: t,
            hh: t,
            d: t,
            dd: t,
            M: t,
            MM: t,
            y: t,
            yy: t,
          },
          dayOfMonthOrdinalParse: /\d{1,2}\./,
          ordinal: "%d.",
          week: { dow: 1, doy: 4 },
        });
      });
    },
  });
});
