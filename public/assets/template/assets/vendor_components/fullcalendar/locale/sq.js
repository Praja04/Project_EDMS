!(function (e, t) {
  "object" == typeof exports && "object" == typeof module
    ? (module.exports = t(require("moment"), require("fullcalendar")))
    : "function" == typeof define && define.amd
      ? define(["moment", "fullcalendar"], t)
      : "object" == typeof exports
        ? t(require("moment"), require("fullcalendar"))
        : t(e.moment, e.FullCalendar);
})("undefined" != typeof self ? self : this, function (e, t) {
  return (function (e) {
    function t(n) {
      if (r[n]) return r[n].exports;
      var a = (r[n] = { i: n, l: !1, exports: {} });
      return e[n].call(a.exports, a, a.exports, t), (a.l = !0), a.exports;
    }
    var r = {};
    return (
      (t.m = e),
      (t.c = r),
      (t.d = function (e, r, n) {
        t.o(e, r) ||
          Object.defineProperty(e, r, {
            configurable: !1,
            enumerable: !0,
            get: n,
          });
      }),
      (t.n = function (e) {
        var r =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return t.d(r, "a", r), r;
      }),
      (t.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }),
      (t.p = ""),
      t((t.s = 187))
    );
  })({
    0: function (t, r) {
      t.exports = e;
    },
    1: function (e, r) {
      e.exports = t;
    },
    187: function (e, t, r) {
      Object.defineProperty(t, "__esModule", { value: !0 }), r(188);
      var n = r(1);
      n.datepickerLocale("sq", "sq", {
        closeText: "mbylle",
        prevText: "&#x3C;mbrapa",
        nextText: "Përpara&#x3E;",
        currentText: "sot",
        monthNames: [
          "Janar",
          "Shkurt",
          "Mars",
          "Prill",
          "Maj",
          "Qershor",
          "Korrik",
          "Gusht",
          "Shtator",
          "Tetor",
          "Nëntor",
          "Dhjetor",
        ],
        monthNamesShort: [
          "Jan",
          "Shk",
          "Mar",
          "Pri",
          "Maj",
          "Qer",
          "Kor",
          "Gus",
          "Sht",
          "Tet",
          "Nën",
          "Dhj",
        ],
        dayNames: [
          "E Diel",
          "E Hënë",
          "E Martë",
          "E Mërkurë",
          "E Enjte",
          "E Premte",
          "E Shtune",
        ],
        dayNamesShort: ["Di", "Hë", "Ma", "Më", "En", "Pr", "Sh"],
        dayNamesMin: ["Di", "Hë", "Ma", "Më", "En", "Pr", "Sh"],
        weekHeader: "Ja",
        dateFormat: "dd.mm.yy",
        firstDay: 1,
        isRTL: !1,
        showMonthAfterYear: !1,
        yearSuffix: "",
      }),
        n.locale("sq", {
          buttonText: {
            month: "Muaj",
            week: "Javë",
            day: "Ditë",
            list: "Listë",
          },
          allDayHtml: "Gjithë<br/>ditën",
          eventLimitText: function (e) {
            return "+më tepër " + e;
          },
          noEventsMessage: "Nuk ka evente për të shfaqur",
        });
    },
    188: function (e, t, r) {
      !(function (e, t) {
        t(r(0));
      })(0, function (e) {
        return e.defineLocale("sq", {
          months:
            "Janar_Shkurt_Mars_Prill_Maj_Qershor_Korrik_Gusht_Shtator_Tetor_Nëntor_Dhjetor".split(
              "_",
            ),
          monthsShort: "Jan_Shk_Mar_Pri_Maj_Qer_Kor_Gus_Sht_Tet_Nën_Dhj".split(
            "_",
          ),
          weekdays:
            "E Diel_E Hënë_E Martë_E Mërkurë_E Enjte_E Premte_E Shtunë".split(
              "_",
            ),
          weekdaysShort: "Die_Hën_Mar_Mër_Enj_Pre_Sht".split("_"),
          weekdaysMin: "D_H_Ma_Më_E_P_Sh".split("_"),
          weekdaysParseExact: !0,
          meridiemParse: /PD|MD/,
          isPM: function (e) {
            return "M" === e.charAt(0);
          },
          meridiem: function (e, t, r) {
            return e < 12 ? "PD" : "MD";
          },
          longDateFormat: {
            LT: "HH:mm",
            LTS: "HH:mm:ss",
            L: "DD/MM/YYYY",
            LL: "D MMMM YYYY",
            LLL: "D MMMM YYYY HH:mm",
            LLLL: "dddd, D MMMM YYYY HH:mm",
          },
          calendar: {
            sameDay: "[Sot në] LT",
            nextDay: "[Nesër në] LT",
            nextWeek: "dddd [në] LT",
            lastDay: "[Dje në] LT",
            lastWeek: "dddd [e kaluar në] LT",
            sameElse: "L",
          },
          relativeTime: {
            future: "në %s",
            past: "%s më parë",
            s: "disa sekonda",
            ss: "%d sekonda",
            m: "një minutë",
            mm: "%d minuta",
            h: "një orë",
            hh: "%d orë",
            d: "një ditë",
            dd: "%d ditë",
            M: "një muaj",
            MM: "%d muaj",
            y: "një vit",
            yy: "%d vite",
          },
          dayOfMonthOrdinalParse: /\d{1,2}\./,
          ordinal: "%d.",
          week: { dow: 1, doy: 4 },
        });
      });
    },
  });
});
