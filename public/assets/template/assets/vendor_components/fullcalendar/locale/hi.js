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
    function t(r) {
      if (n[r]) return n[r].exports;
      var o = (n[r] = { i: r, l: !1, exports: {} });
      return e[r].call(o.exports, o, o.exports, t), (o.l = !0), o.exports;
    }
    var n = {};
    return (
      (t.m = e),
      (t.c = n),
      (t.d = function (e, n, r) {
        t.o(e, n) ||
          Object.defineProperty(e, n, {
            configurable: !1,
            enumerable: !0,
            get: r,
          });
      }),
      (t.n = function (e) {
        var n =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return t.d(n, "a", n), n;
      }),
      (t.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t);
      }),
      (t.p = ""),
      t((t.s = 133))
    );
  })({
    0: function (t, n) {
      t.exports = e;
    },
    1: function (e, n) {
      e.exports = t;
    },
    133: function (e, t, n) {
      Object.defineProperty(t, "__esModule", { value: !0 }), n(134);
      var r = n(1);
      r.datepickerLocale("hi", "hi", {
        closeText: "बंद",
        prevText: "पिछला",
        nextText: "अगला",
        currentText: "आज",
        monthNames: [
          "जनवरी ",
          "फरवरी",
          "मार्च",
          "अप्रेल",
          "मई",
          "जून",
          "जूलाई",
          "अगस्त ",
          "सितम्बर",
          "अक्टूबर",
          "नवम्बर",
          "दिसम्बर",
        ],
        monthNamesShort: [
          "जन",
          "फर",
          "मार्च",
          "अप्रेल",
          "मई",
          "जून",
          "जूलाई",
          "अग",
          "सित",
          "अक्ट",
          "नव",
          "दि",
        ],
        dayNames: [
          "रविवार",
          "सोमवार",
          "मंगलवार",
          "बुधवार",
          "गुरुवार",
          "शुक्रवार",
          "शनिवार",
        ],
        dayNamesShort: ["रवि", "सोम", "मंगल", "बुध", "गुरु", "शुक्र", "शनि"],
        dayNamesMin: ["रवि", "सोम", "मंगल", "बुध", "गुरु", "शुक्र", "शनि"],
        weekHeader: "हफ्ता",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: !1,
        showMonthAfterYear: !1,
        yearSuffix: "",
      }),
        r.locale("hi", {
          buttonText: {
            month: "महीना",
            week: "सप्ताह",
            day: "दिन",
            list: "कार्यसूची",
          },
          allDayText: "सभी दिन",
          eventLimitText: function (e) {
            return "+अधिक " + e;
          },
          noEventsMessage: "कोई घटनाओं को प्रदर्शित करने के लिए",
        });
    },
    134: function (e, t, n) {
      !(function (e, t) {
        t(n(0));
      })(0, function (e) {
        var t = {
            1: "१",
            2: "२",
            3: "३",
            4: "४",
            5: "५",
            6: "६",
            7: "७",
            8: "८",
            9: "९",
            0: "०",
          },
          n = {
            "१": "1",
            "२": "2",
            "३": "3",
            "४": "4",
            "५": "5",
            "६": "6",
            "७": "7",
            "८": "8",
            "९": "9",
            "०": "0",
          };
        return e.defineLocale("hi", {
          months:
            "जनवरी_फ़रवरी_मार्च_अप्रैल_मई_जून_जुलाई_अगस्त_सितम्बर_अक्टूबर_नवम्बर_दिसम्बर".split(
              "_",
            ),
          monthsShort:
            "जन._फ़र._मार्च_अप्रै._मई_जून_जुल._अग._सित._अक्टू._नव._दिस.".split(
              "_",
            ),
          monthsParseExact: !0,
          weekdays:
            "रविवार_सोमवार_मंगलवार_बुधवार_गुरूवार_शुक्रवार_शनिवार".split("_"),
          weekdaysShort: "रवि_सोम_मंगल_बुध_गुरू_शुक्र_शनि".split("_"),
          weekdaysMin: "र_सो_मं_बु_गु_शु_श".split("_"),
          longDateFormat: {
            LT: "A h:mm बजे",
            LTS: "A h:mm:ss बजे",
            L: "DD/MM/YYYY",
            LL: "D MMMM YYYY",
            LLL: "D MMMM YYYY, A h:mm बजे",
            LLLL: "dddd, D MMMM YYYY, A h:mm बजे",
          },
          calendar: {
            sameDay: "[आज] LT",
            nextDay: "[कल] LT",
            nextWeek: "dddd, LT",
            lastDay: "[कल] LT",
            lastWeek: "[पिछले] dddd, LT",
            sameElse: "L",
          },
          relativeTime: {
            future: "%s में",
            past: "%s पहले",
            s: "कुछ ही क्षण",
            ss: "%d सेकंड",
            m: "एक मिनट",
            mm: "%d मिनट",
            h: "एक घंटा",
            hh: "%d घंटे",
            d: "एक दिन",
            dd: "%d दिन",
            M: "एक महीने",
            MM: "%d महीने",
            y: "एक वर्ष",
            yy: "%d वर्ष",
          },
          preparse: function (e) {
            return e.replace(/[१२३४५६७८९०]/g, function (e) {
              return n[e];
            });
          },
          postformat: function (e) {
            return e.replace(/\d/g, function (e) {
              return t[e];
            });
          },
          meridiemParse: /रात|सुबह|दोपहर|शाम/,
          meridiemHour: function (e, t) {
            return (
              12 === e && (e = 0),
              "रात" === t
                ? e < 4
                  ? e
                  : e + 12
                : "सुबह" === t
                  ? e
                  : "दोपहर" === t
                    ? e >= 10
                      ? e
                      : e + 12
                    : "शाम" === t
                      ? e + 12
                      : void 0
            );
          },
          meridiem: function (e, t, n) {
            return e < 4
              ? "रात"
              : e < 10
                ? "सुबह"
                : e < 17
                  ? "दोपहर"
                  : e < 20
                    ? "शाम"
                    : "रात";
          },
          week: { dow: 0, doy: 6 },
        });
      });
    },
  });
});
