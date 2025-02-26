!(function (e, o) {
  "object" == typeof exports && "object" == typeof module
    ? (module.exports = o(require("moment"), require("fullcalendar")))
    : "function" == typeof define && define.amd
      ? define(["moment", "fullcalendar"], o)
      : "object" == typeof exports
        ? o(require("moment"), require("fullcalendar"))
        : o(e.moment, e.FullCalendar);
})("undefined" != typeof self ? self : this, function (e, o) {
  return (function (e) {
    function o(n) {
      if (t[n]) return t[n].exports;
      var r = (t[n] = { i: n, l: !1, exports: {} });
      return e[n].call(r.exports, r, r.exports, o), (r.l = !0), r.exports;
    }
    var t = {};
    return (
      (o.m = e),
      (o.c = t),
      (o.d = function (e, t, n) {
        o.o(e, t) ||
          Object.defineProperty(e, t, {
            configurable: !1,
            enumerable: !0,
            get: n,
          });
      }),
      (o.n = function (e) {
        var t =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return o.d(t, "a", t), t;
      }),
      (o.o = function (e, o) {
        return Object.prototype.hasOwnProperty.call(e, o);
      }),
      (o.p = ""),
      o((o.s = 111))
    );
  })({
    0: function (o, t) {
      o.exports = e;
    },
    1: function (e, t) {
      e.exports = o;
    },
    111: function (e, o, t) {
      Object.defineProperty(o, "__esModule", { value: !0 }), t(112);
      var n = t(1);
      n.datepickerLocale("es-us", "es", {
        closeText: "Cerrar",
        prevText: "&#x3C;Ant",
        nextText: "Sig&#x3E;",
        currentText: "Hoy",
        monthNames: [
          "enero",
          "febrero",
          "marzo",
          "abril",
          "mayo",
          "junio",
          "julio",
          "agosto",
          "septiembre",
          "octubre",
          "noviembre",
          "diciembre",
        ],
        monthNamesShort: [
          "ene",
          "feb",
          "mar",
          "abr",
          "may",
          "jun",
          "jul",
          "ago",
          "sep",
          "oct",
          "nov",
          "dic",
        ],
        dayNames: [
          "domingo",
          "lunes",
          "martes",
          "miércoles",
          "jueves",
          "viernes",
          "sábado",
        ],
        dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
        dayNamesMin: ["D", "L", "M", "X", "J", "V", "S"],
        weekHeader: "Sm",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: !1,
        showMonthAfterYear: !1,
        yearSuffix: "",
      }),
        n.locale("es-us", {
          buttonText: {
            month: "Mes",
            week: "Semana",
            day: "Día",
            list: "Agenda",
          },
          allDayHtml: "Todo<br/>el día",
          eventLimitText: "más",
          noEventsMessage: "No hay eventos para mostrar",
        });
    },
    112: function (e, o, t) {
      !(function (e, o) {
        o(t(0));
      })(0, function (e) {
        var o =
            "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split(
              "_",
            ),
          t = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_");
        return e.defineLocale("es-us", {
          months:
            "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split(
              "_",
            ),
          monthsShort: function (e, n) {
            return e ? (/-MMM-/.test(n) ? t[e.month()] : o[e.month()]) : o;
          },
          monthsParseExact: !0,
          weekdays:
            "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
          weekdaysShort: "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
          weekdaysMin: "do_lu_ma_mi_ju_vi_sá".split("_"),
          weekdaysParseExact: !0,
          longDateFormat: {
            LT: "h:mm A",
            LTS: "h:mm:ss A",
            L: "MM/DD/YYYY",
            LL: "MMMM [de] D [de] YYYY",
            LLL: "MMMM [de] D [de] YYYY h:mm A",
            LLLL: "dddd, MMMM [de] D [de] YYYY h:mm A",
          },
          calendar: {
            sameDay: function () {
              return "[hoy a la" + (1 !== this.hours() ? "s" : "") + "] LT";
            },
            nextDay: function () {
              return "[mañana a la" + (1 !== this.hours() ? "s" : "") + "] LT";
            },
            nextWeek: function () {
              return "dddd [a la" + (1 !== this.hours() ? "s" : "") + "] LT";
            },
            lastDay: function () {
              return "[ayer a la" + (1 !== this.hours() ? "s" : "") + "] LT";
            },
            lastWeek: function () {
              return (
                "[el] dddd [pasado a la" +
                (1 !== this.hours() ? "s" : "") +
                "] LT"
              );
            },
            sameElse: "L",
          },
          relativeTime: {
            future: "en %s",
            past: "hace %s",
            s: "unos segundos",
            ss: "%d segundos",
            m: "un minuto",
            mm: "%d minutos",
            h: "una hora",
            hh: "%d horas",
            d: "un día",
            dd: "%d días",
            M: "un mes",
            MM: "%d meses",
            y: "un año",
            yy: "%d años",
          },
          dayOfMonthOrdinalParse: /\d{1,2}º/,
          ordinal: "%dº",
          week: { dow: 0, doy: 6 },
        });
      });
    },
  });
});
