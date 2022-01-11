<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/urbanismo_y_licencias.css">
</head>

<body>
    <div class="section-proyectos">
        <div class="container-fluid aos-init aos-animate" data-aos="fade" data-aos-delay="500">
            <div class="swiper-container images-carousel swiper-container-horizontal swiper-container-free-mode">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                    <div class="swiper-slide swiper-slide-active" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">Nature</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <script data-pagespeed-no-defer="">
                                //<![CDATA[
                                (function() {
                                    for (var g = "function" == typeof Object.defineProperties ? Object.defineProperty : function(b, c, a) {
                                            if (a.get || a.set) throw new TypeError("ES3 does not support getters and setters.");
                                            b != Array.prototype && b != Object.prototype && (b[c] = a.value)
                                        }, h = "undefined" != typeof window && window === this ? this : "undefined" != typeof global && null != global ? global : this, k = ["String", "prototype", "repeat"], l = 0; l < k.length - 1; l++) {
                                        var m = k[l];
                                        m in h || (h[m] = {});
                                        h = h[m]
                                    }
                                    var n = k[k.length - 1],
                                        p = h[n],
                                        q = p ? p : function(b) {
                                            var c;
                                            if (null == this) throw new TypeError("The 'this' value for String.prototype.repeat must not be null or undefined");
                                            c = this + "";
                                            if (0 > b || 1342177279 < b) throw new RangeError("Invalid count value");
                                            b |= 0;
                                            for (var a = ""; b;)
                                                if (b & 1 && (a += c), b >>>= 1) c += c;
                                            return a
                                        };
                                    q != p && null != q && g(h, n, {
                                        configurable: !0,
                                        writable: !0,
                                        value: q
                                    });
                                    var t = this;

                                    function u(b, c) {
                                        var a = b.split("."),
                                            d = t;
                                        a[0] in d || !d.execScript || d.execScript("var " + a[0]);
                                        for (var e; a.length && (e = a.shift());) a.length || void 0 === c ? d[e] ? d = d[e] : d = d[e] = {} : d[e] = c
                                    };

                                    function v(b) {
                                        var c = b.length;
                                        if (0 < c) {
                                            for (var a = Array(c), d = 0; d < c; d++) a[d] = b[d];
                                            return a
                                        }
                                        return []
                                    };

                                    function w(b) {
                                        var c = window;
                                        if (c.addEventListener) c.addEventListener("load", b, !1);
                                        else if (c.attachEvent) c.attachEvent("onload", b);
                                        else {
                                            var a = c.onload;
                                            c.onload = function() {
                                                b.call(this);
                                                a && a.call(this)
                                            }
                                        }
                                    };
                                    var x;

                                    function y(b, c, a, d, e) {
                                        this.h = b;
                                        this.j = c;
                                        this.l = a;
                                        this.f = e;
                                        this.g = {
                                            height: window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight,
                                            width: window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
                                        };
                                        this.i = d;
                                        this.b = {};
                                        this.a = [];
                                        this.c = {}
                                    }

                                    function z(b, c) {
                                        var a, d, e = c.getAttribute("data-pagespeed-url-hash");
                                        if (a = e && !(e in b.c))
                                            if (0 >= c.offsetWidth && 0 >= c.offsetHeight) a = !1;
                                            else {
                                                d = c.getBoundingClientRect();
                                                var f = document.body;
                                                a = d.top + ("pageYOffset" in window ? window.pageYOffset : (document.documentElement || f.parentNode || f).scrollTop);
                                                d = d.left + ("pageXOffset" in window ? window.pageXOffset : (document.documentElement || f.parentNode || f).scrollLeft);
                                                f = a.toString() + "," + d;
                                                b.b.hasOwnProperty(f) ? a = !1 : (b.b[f] = !0, a = a <= b.g.height && d <= b.g.width)
                                            } a && (b.a.push(e),
                                            b.c[e] = !0)
                                    }
                                    y.prototype.checkImageForCriticality = function(b) {
                                        b.getBoundingClientRect && z(this, b)
                                    };
                                    u("pagespeed.CriticalImages.checkImageForCriticality", function(b) {
                                        x.checkImageForCriticality(b)
                                    });
                                    u("pagespeed.CriticalImages.checkCriticalImages", function() {
                                        A(x)
                                    });

                                    function A(b) {
                                        b.b = {};
                                        for (var c = ["IMG", "INPUT"], a = [], d = 0; d < c.length; ++d) a = a.concat(v(document.getElementsByTagName(c[d])));
                                        if (a.length && a[0].getBoundingClientRect) {
                                            for (d = 0; c = a[d]; ++d) z(b, c);
                                            a = "oh=" + b.l;
                                            b.f && (a += "&n=" + b.f);
                                            if (c = !!b.a.length)
                                                for (a += "&ci=" + encodeURIComponent(b.a[0]), d = 1; d < b.a.length; ++d) {
                                                    var e = "," + encodeURIComponent(b.a[d]);
                                                    131072 >= a.length + e.length && (a += e)
                                                }
                                            b.i && (e = "&rd=" + encodeURIComponent(JSON.stringify(B())), 131072 >= a.length + e.length && (a += e), c = !0);
                                            C = a;
                                            if (c) {
                                                d = b.h;
                                                b = b.j;
                                                var f;
                                                if (window.XMLHttpRequest) f =
                                                    new XMLHttpRequest;
                                                else if (window.ActiveXObject) try {
                                                    f = new ActiveXObject("Msxml2.XMLHTTP")
                                                } catch (r) {
                                                    try {
                                                        f = new ActiveXObject("Microsoft.XMLHTTP")
                                                    } catch (D) {}
                                                }
                                                f && (f.open("POST", d + (-1 == d.indexOf("?") ? "?" : "&") + "url=" + encodeURIComponent(b)), f.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), f.send(a))
                                            }
                                        }
                                    }

                                    function B() {
                                        var b = {},
                                            c;
                                        c = document.getElementsByTagName("IMG");
                                        if (!c.length) return {};
                                        var a = c[0];
                                        if (!("naturalWidth" in a && "naturalHeight" in a)) return {};
                                        for (var d = 0; a = c[d]; ++d) {
                                            var e = a.getAttribute("data-pagespeed-url-hash");
                                            e && (!(e in b) && 0 < a.width && 0 < a.height && 0 < a.naturalWidth && 0 < a.naturalHeight || e in b && a.width >= b[e].o && a.height >= b[e].m) && (b[e] = {
                                                rw: a.width,
                                                rh: a.height,
                                                ow: a.naturalWidth,
                                                oh: a.naturalHeight
                                            })
                                        }
                                        return b
                                    }
                                    var C = "";
                                    u("pagespeed.CriticalImages.getBeaconData", function() {
                                        return C
                                    });
                                    u("pagespeed.CriticalImages.Run", function(b, c, a, d, e, f) {
                                        var r = new y(b, c, a, e, f);
                                        x = r;
                                        d && w(function() {
                                            window.setTimeout(function() {
                                                A(r)
                                            }, 0)
                                        })
                                    });
                                })();

                                pagespeed.CriticalImages.Run('/mod_pagespeed_beacon', 'https://preview.colorlib.com/theme/photon/', '-ilGEe-FWC', true, false, 'DrPiKsCxwCM');
                                //]]>
                            </script><img src="images/ximg_1.jpg.pagespeed.ic.dVOZgSx7Zd.webp" alt="Image" data-pagespeed-url-hash="3903216269" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-next" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">Portrait</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <img src="images/ximg_2.jpg.pagespeed.ic.PM5e-rTip9.webp" alt="Image" data-pagespeed-url-hash="4197716190" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">People</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <img src="images/ximg_3.jpg.pagespeed.ic.bk3yZAfTGF.webp" alt="Image" data-pagespeed-url-hash="197248815" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">Architecture</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <img src="images/ximg_4.jpg.pagespeed.ic.R3Bo7CojLw.webp" alt="Image" data-pagespeed-url-hash="491748736" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">Animals</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <img src="images/ximg_5.jpg.pagespeed.ic.i2UxfK_E3n.webp" alt="Image" data-pagespeed-url-hash="786248657" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">Sports</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <img src="images/ximg_6.jpg.pagespeed.ic.Qp_L1djBaX.webp" alt="Image" data-pagespeed-url-hash="1080748578" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 417.333px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3">Travel</h2>
                                <a href="single.html" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <img src="images/ximg_7.jpg.pagespeed.ic.XxW8l6cI0Q.webp" alt="Image" data-pagespeed-url-hash="1375248499" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span></div>
                <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"></div>
                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>
                <div class="swiper-scrollbar"></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </div>
</body>