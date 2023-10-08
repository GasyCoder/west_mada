"use strict";
function _typeof(e) {
    return (_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
        return typeof e
    }
        : function (e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        }
    )(e)
}
!function (e) {
    var t, a, o;
    "function" == typeof define && define.amd && (define(e),
        t = !0),
        "object" === ("undefined" == typeof exports ? "undefined" : _typeof(exports)) && (module.exports = e(),
            t = !0),
        t || (a = window.Cookies,
            (o = window.Cookies = e()).noConflict = function () {
                return window.Cookies = a,
                    o
            }
        )
}(function () {
    function s() {
        for (var e = 0, t = {}; e < arguments.length; e++) {
            var a, o = arguments[e];
            for (a in o)
                t[a] = o[a]
        }
        return t
    }
    function l(e) {
        return e.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent)
    }
    return function e(d) {
        function r() { }
        function a(e, t, a) {
            if ("undefined" != typeof document) {
                "number" == typeof (a = s({
                    path: "/"
                }, r.defaults, a)).expires && (a.expires = new Date(+new Date + 864e5 * a.expires)),
                    a.expires = a.expires ? a.expires.toUTCString() : "";
                try {
                    var o = JSON.stringify(t);
                    /^[\{\[]/.test(o) && (t = o)
                } catch (e) { }
                t = d.write ? d.write(t, e) : encodeURIComponent(String(t)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent),
                    e = encodeURIComponent(String(e)).replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent).replace(/[\(\)]/g, escape);
                var n, i = "";
                for (n in a)
                    a[n] && (i += "; " + n,
                        !0 !== a[n]) && (i += "=" + a[n].split(";")[0]);
                return document.cookie = e + "=" + t + i
            }
        }
        function t(e, t) {
            if ("undefined" != typeof document) {
                for (var a = {}, o = document.cookie ? document.cookie.split("; ") : [], n = 0; n < o.length; n++) {
                    var i = o[n].split("=")
                        , r = i.slice(1).join("=");
                    t || '"' !== r.charAt(0) || (r = r.slice(1, -1));
                    try {
                        var s = l(i[0])
                            , r = (d.read || d)(r, s) || l(r);
                        if (t)
                            try {
                                r = JSON.parse(r)
                            } catch (e) { }
                        if (a[s] = r,
                            e === s)
                            break
                    } catch (e) { }
                }
                return e ? a[e] : a
            }
        }
        return r.set = a,
            r.get = function (e) {
                return t(e, !1)
            }
            ,
            r.getJSON = function (e) {
                return t(e, !0)
            }
            ,
            r.remove = function (e, t) {
                a(e, "", s(t, {
                    expires: -1
                }))
            }
            ,
            r.defaults = {},
            r.withConverter = e,
            r
    }(function () { })
}),
    function (r, s) {
        var d = s("body")
            , l = s("head")
            , u = "#skin-theme"
            , m = ".nk-sidebar"
            , c = ".nk-header"
            , f = ["demo1", "general"]
            , i = ["style", "aside", "header", "skin", "mode"]
            , n = "light-mode"
            , p = "dark-mode"
            , h = ".nk-opt-item"
            , v = ".nk-opt-list"
            , y = {
                demo1: {
                    aside: "is-dark",
                    header: "is-light",
                    style: "ui-default"
                },
                general: {
                    aside: "is-dark",
                    header: "is-light",
                    style: "ui-default"
                }
            };
        r.Demo = {
            save: function (e, t) {
                Cookies.set(r.Demo.apps(e), t)
            },
            remove: function (e) {
                Cookies.remove(r.Demo.apps(e))
            },
            current: function (e) {
                return Cookies.get(r.Demo.apps(e))
            },
            apps: function (e) {
                for (var t, a = window.location.pathname.split("/").map(function (e, t, a) {
                    return e.replace("-", "")
                }), o = 0, n = f; o < n.length; o++) {
                    var i = n[o];
                    0 <= a.indexOf(i) && (t = i)
                }
                return e ? e + "_" + t : t
            },
            style: function (e, t) {
                var a = {
                    mode: n + " " + p,
                    style: "ui-default ui-clean ui-shady ui-softy",
                    aside: "is-light is-default is-theme is-dark",
                    header: "is-light is-default is-theme is-dark"
                };
                return "all" === e ? a[t] || "" : "any" === e ? a.mode + " " + a.style + " " + a.aside + " " + a.header : "body" === e ? a.mode + " " + a.style : "is-default" === e || "ui-default" === e ? "" : e
            },
            skins: function (e) {
                return !e || "default" === e ? "theme" : "theme-" + e
            },
            defs: function (e) {
                var t = r.Demo.apps()
                    , t = y[t][e] || "";
                return r.Demo.current(e) ? r.Demo.current(e) : t
            },
            apply: function () {
                r.Demo.apps();
                for (var e = 0, t = i; e < t.length; e++) {
                    var a, o, n = t[e];
                    "aside" !== n && "header" !== n && "style" !== n || (a = r.Demo.defs(n),
                        s(o = "aside" === n ? m : "header" === n ? c : d).removeClass(r.Demo.style("all", n)),
                        "ui-default" !== a && "is-default" !== a && s(o).addClass(a)),
                        "mode" === n && r.Demo.update(n, r.Demo.current("mode")),
                        "skin" === n && r.Demo.update(n, r.Demo.current("skin"))
                }
                r.Demo.update("dir", r.Demo.current("dir"))
            },
            locked: function (e) {
                !0 === e ? (s(h + "[data-key=aside]").add(h + "[data-key=header]").add(h + "[data-key=skin]").addClass("disabled"),
                    r.Demo.update("skin", "default", !0),
                    s(h + "[data-key=skin]").removeClass("active"),
                    s(h + "[data-key=skin][data-update=default]").addClass("active")) : s(h + "[data-key=aside]").add(h + "[data-key=header]").add(h + "[data-key=skin]").removeClass("disabled")
            },
            update: function (e, t, a) {
                var o, n = r.Demo.style(t, e), i = r.Demo.style("all", e);
                r.Demo.apps();
                "aside" !== e && "header" !== e || (s(o = "header" == e ? c : m).removeClass(i),
                    s(o).addClass(n)),
                    "mode" === e && (d.removeClass(i).removeAttr("theme"),
                        n === p ? (d.addClass(n).attr("theme", "dark"),
                            r.Demo.locked(!0)) : (d.addClass(n).removeAttr("theme"),
                                r.Demo.locked(!1))),
                    "style" === e && (d.removeClass(i),
                        d.addClass(n)),
                    "skin" === e && (o = r.Demo.skins(n),
                        i = s("#skin-default").attr("href").replace("theme", "skins/" + o),
                        "theme" === o ? s(u).remove() : 0 < s(u).length ? s(u).attr("href", i) : l.append('<link id="skin-theme" rel="stylesheet" href="' + i + '">')),
                    !0 === a && r.Demo.save(e, t)
            },
            reset: function () {
                var t = r.Demo.apps();
                d.removeClass(r.Demo.style("body")).removeAttr("theme"),
                    s(h).removeClass("active"),
                    s(u).remove(),
                    s(m).removeClass(r.Demo.style("all", "aside")),
                    s(c).removeClass(r.Demo.style("all", "header"));
                for (var e = 0, a = i; e < a.length; e++) {
                    var o = a[e];
                    s("[data-key='" + o + "']").each(function () {
                        var e = s(this).data("update");
                        "aside" !== o && "header" !== o && "style" !== o || e === y[t][o] && s(this).addClass("active"),
                            "mode" !== o && "skin" !== o || e !== n && "default" !== e || s(this).addClass("active")
                    }),
                        r.Demo.remove(o)
                }
                s("[data-key='dir']").each(function () {
                    s(this).data("update") === r.Demo.current("dir") && s(this).addClass("active")
                }),
                    r.Demo.apply()
            },
            load: function () {
                r.Demo.apply(),
                    0 < s(h).length && s(h).each(function () {
                        var e = s(this).data("update")
                            , t = s(this).data("key");
                        "aside" !== t && "header" !== t && "style" !== t || e === r.Demo.defs(t) && (s(this).parent(v).find(h).removeClass("active"),
                            s(this).addClass("active")),
                            "mode" !== t && "skin" !== t && "dir" !== t || e != r.Demo.current("skin") && e != r.Demo.current("mode") && e != r.Demo.current("dir") || (s(this).parent(v).find(h).removeClass("active"),
                                s(this).addClass("active"))
                    })
            },
            trigger: function () {
                s(h).on("click", function (e) {
                    e.preventDefault();
                    var e = s(this)
                        , t = e.parent(v)
                        , a = e.data("update")
                        , o = e.data("key");
                    r.Demo.update(o, a, !0),
                        t.find(h).removeClass("active"),
                        e.addClass("active"),
                        "dir" == o && setTimeout(function () {
                            window.location.reload()
                        }, 100)
                }),
                    s(".nk-opt-reset > a").on("click", function (e) {
                        e.preventDefault(),
                            r.Demo.reset()
                    })
            },
            init: function (e) {
                r.Demo.load(),
                    r.Demo.trigger()
            }
        },
            r.coms.docReady.push(r.Demo.init),
            r.Promo = function () {
                var t = s(".pmo-st")
                    , a = s(".pmo-lv")
                    , e = s(".pmo-close");
                0 < e.length && e.on("click", function () {
                    var e = Cookies.get("intm-offer");
                    return a.removeClass("active"),
                        t.addClass("active"),
                        null == e && Cookies.set("intm-offer", "true", {
                            expires: 1,
                            path: ""
                        }),
                        !1
                }),
                    s(window).on("load", function () {
                        (null == Cookies.get("intm-offer") ? a : t).addClass("active")
                    })
            }
            ,
            r.coms.docReady.push(r.Promo)
    }(NioApp, jQuery);
