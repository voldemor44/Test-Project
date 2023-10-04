<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.colorlib.com/theme/agenda/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Oct 2023 11:34:28 GMT -->

<head>
    <title>Hello World</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script nonce="a1b2ef30-5996-4507-9b40-16863c54b2ff">
        (function(w, d) {
            ! function(a, b, c, d) {
                a[c] = a[c] || {};
                a[c].executed = [];
                a.zaraz = {
                    deferred: [],
                    listeners: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return async function() {
                        var f = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: f
                        })
                    }
                };
                for (const g of ["track", "set", "debug"]) a.zaraz[g] = a.zaraz._f(g);
                a.zaraz.init = () => {
                    var h = b.getElementsByTagName(d)[0],
                        i = b.createElement(d),
                        j = b.getElementsByTagName("title")[0];
                    j && (a[c].t = b.getElementsByTagName("title")[0].text);
                    a[c].x = Math.random();
                    a[c].w = a.screen.width;
                    a[c].h = a.screen.height;
                    a[c].j = a.innerHeight;
                    a[c].e = a.innerWidth;
                    a[c].l = a.location.href;
                    a[c].r = b.referrer;
                    a[c].k = a.screen.colorDepth;
                    a[c].n = b.characterSet;
                    a[c].o = (new Date).getTimezoneOffset();
                    if (a.dataLayer)
                        for (const n of Object.entries(Object.entries(dataLayer).reduce(((o, p) => ({
                                ...o[1],
                                ...p[1]
                            })), {}))) zaraz.set(n[0], n[1], {
                            scope: "page"
                        });
                    a[c].q = [];
                    for (; a.zaraz.q.length;) {
                        const q = a.zaraz.q.shift();
                        a[c].q.push(q)
                    }
                    i.defer = !0;
                    for (const r of [localStorage, sessionStorage]) Object.keys(r || {}).filter((t => t.startsWith(
                        "_zaraz_"))).forEach((s => {
                        try {
                            a[c]["z_" + s.slice(7)] = JSON.parse(r.getItem(s))
                        } catch {
                            a[c]["z_" + s.slice(7)] = r.getItem(s)
                        }
                    }));
                    i.referrerPolicy = "origin";
                    i.src = "https://preview.colorlib.com/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON
                        .stringify(a[c])));
                    h.parentNode.insertBefore(i, h)
                };
                ["complete", "interactive"].includes(b.readyState) ? zaraz.init() : a.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body>
    <header class="site-header">
        <div class="header-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-10 col-lg-2 order-lg-1">
                        <div class="site-branding">
                            <div class="site-title">
                                <a href="#"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-lg-7 order-3 order-lg-2">
                        <nav class="site-navigation">
                            <div class="hamburger-menu d-lg-none">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <ul>
                                <li><a href="#">A propos</a></li>
                                <li><a href="#">Evenements</a></li>
                                <li><a href="#">Actualités</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block order-2 order-lg-3">
                        <div class="buy-tickets">
                            <a class="btn gradient-bg" href="{{ route('login') }}">Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-container hero-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-date="2018/05/01"
                    style="margin-top: -6%; background: url({{ asset('assets/images/red1.jpg') }}) no-repeat">
                    <div class="hero-content">
                        <div class="container">
                            <div class="row">
                                <div class="col flex flex-column justify-content-center">
                                    <div class="entry-header">
                                        <h2 class="entry-title">Réservez vos moments <br> mémorables en un clic.</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-date="2019/05/01"
                    style="margin-top: -6%; background: url({{ asset('assets/images/header-bg.jpg') }}) no-repeat">
                    <div class="hero-content">
                        <div class="container">
                            <div class="row">
                                <div class="col flex flex-column justify-content-center">
                                    <div class="entry-header">
                                        <h2 class="entry-title">Voulez-vous participer à un événement ? Acheter votre
                                            ticket ici.</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" data-date="2020/05/01"
                    style="margin-top: -6%; background: url({{ asset('assets/images/header-bg.jpg') }}) no-repeat">
                    <div class="hero-content">
                        <div class="container">
                            <div class="row">
                                <div class="col flex flex-column justify-content-center">
                                    <div class="entry-header">

                                        <h2 class="entry-title"> Mettez-vous au parfum des événements.</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-button-next flex justify-content-center align-items-center">
                <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z" />
                    </svg></span>
            </div>
            <div class="swiper-button-prev flex justify-content-center align-items-center">
                <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z" />
                    </svg></span>
            </div>
        </div>
    </header>

    <div class="homepage-regional-events">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header
                        class="regional-events-heading entry-header flex flex-wrap justify-content-between align-items-center">
                        <h4 class="entry-title">Choisissez un genre d'évènement</h4>
                        <div class="select-location">
                            <select aria-placeholder="">
                                <option>Les genres</option>
                                <option>Sports</option>
                                <option>Musique</option>
                            </select>
                        </div>
                    </header>
                    <div class="swiper-container homepage-regional-events-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-1.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">U2 Concert </h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-2.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Broadway Hit </h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-3.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Gallery Exibition</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-4.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Art Gallery</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-5.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Music Concert</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-6.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">EDM Festival</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-1.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">U2 Concert </h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-button-next flex justify-content-center align-items-center">
                            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z" />
                                </svg></span>
                        </div>
                        <div class="swiper-button-prev flex justify-content-center align-items-center">
                            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z" />
                                </svg></span>
                        </div>
                    </div>

                    <div class="swiper-container homepage-regional-events-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-1.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">U2 Concert </h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-2.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Broadway Hit </h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-3.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Gallery Exibition</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-4.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Art Gallery</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-5.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">Music Concert</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-6.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">EDM Festival</h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <figure>
                                    <img src="{{ asset('assets/images/event-slider-1.jpg') }}" alt>
                                    <a class="event-overlay-link flex justify-content-center align-items-center"
                                        href="#"></a>
                                </figure>
                                <div class="entry-header">
                                    <h2 class="entry-title">U2 Concert </h2>
                                </div>
                                <div class="entry-footer">
                                    <div class="posted-date">Saturday <span>Jan 27, 2018</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-button-next flex justify-content-center align-items-center">
                            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z" />
                                </svg></span>
                        </div>
                        <div class="swiper-button-prev flex justify-content-center align-items-center">
                            <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z" />
                                </svg></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com/" target="_blank">Colorlib</a>

                    <div class="footer-social">
                        <ul class="flex flex-wrap justify-content-center align-items-center">
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="back-to-top flex justify-content-center align-items-center">
        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z" />
            </svg></span>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.collapsible.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.countTo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"80fca2e719f999cc","version":"2023.8.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}'
        crossorigin="anonymous"></script>
</body>

<!-- Mirrored from preview.colorlib.com/theme/agenda/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Oct 2023 11:35:06 GMT -->

</html>
