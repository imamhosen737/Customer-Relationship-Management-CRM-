function convertHex(e,a) {
    return e=e.replace("#",""),r=parseInt(e.substring(0,2),16),g=parseInt(e.substring(2,4),16),b=parseInt(e.substring(4,6),16),result="rgba("+r+", "+g+", "+b+", "+a+")",result}

!function(e) {
    "use strict";e(document).on("ready",function() {
        var a,n;t(),e("*[data-pattern-overlay-darkness-opacity]").each(function() {
            var a=e(this).data("pattern-overlay-darkness-opacity");e(this).css("background-color",convertHex("#000000",a))}

        ),e("*[data-pattern-overlay-background-image]").each(function() {
            "none"==e(this).data("pattern-overlay-background-image")?e(this).css("background-image","none"): "yes"==e(this).data("pattern-overlay-background-image")&&e(this).css("background-image")
        }

        ),e("*[data-remove-pattern-overlay]").each(function() {
            "yes"==e(this).data("remove-pattern-overlay")&&e(this).css("background","none")}

        ),e("*[data-bg-color]").each(function() {
            var a=e(this).data("bg-color");e(this).css("background-color",a)}

        ),e("*[data-bg-color-opacity]").each(function() {
            var a=e(this).data("bg-color-opacity"),t=e(this).css("background-color"),i=t.replace("rgb","rgba").replace(")",", "+a+")");e(this).css("background-color",i)}

        ),e("*[data-bg-img]").each(function() {
            var a=e(this).data("bg-img");e(this).css("background-image","url('"+a+"')")}

        ),e("*[data-parallax-bg-img]").each(function() {
            var a=e(this).data("parallax-bg-img");e(this).css("background-image","url('./lead_assets/images/files/parallax-bg/"+a+"')")}

        ),i(),e(".img-bg").each(function() {
            var a=e(this),t=a.find("img").attr("src");if(a.parent(".section-image").length)a.css("background-image","url('"+t+"')");else {
                a.prepend("<div class='bg-element'></div>");var i=a.find(".bg-element");i.css("background-image","url('"+t+"')")}

            a.find("img").css( {
                opacity: 0,visibility:"hidden"
            }

            )}

        ),e("#full-container").fitVids(),e(".video-background").each(function() {
            e(this).YTPlayer( {
                mute: !1,autoPlay:!0,opacity:1,containment:".video-background",showControls:!1,startAt:0,addRaster:!0,showYTLogo:!1,stopMovieOnBlur:!1
            }

            )}

        ),e(".lightbox-img").magnificPopup( {
            type: "image",gallery: {
                enabled:!1
            }

            ,mainClass: "mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1
        }

        ),e(".lightbox-gallery").magnificPopup( {
            type: "image",gallery: {
                enabled:!0
            }

            ,mainClass: "mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1
        }

        ),e(".lightbox-iframe").magnificPopup( {
            type: "iframe",mainClass:"mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1
        }

        ),l(),a=e(".banner-parallax"),n=a.children("img:first-child").attr("src"),a.prepend("<div class='bg-element'></div>"),a.find("> .bg-element").css("background-image","url('"+n+"')").attr("data-stellar-background-ratio",.2),e(".banner-slider > .owl-carousel").owlCarousel( {
            items: 1,rtl:s,autoplay:!1,autoplaySpeed:800,autoplayTimeout:4e3,dragEndSpeed:600,autoplayHoverPause:!0,loop:!0,slideBy:1,margin:10,stagePadding:0,nav:!0,dots:!0,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsive: {
                0: {
                }

                ,480: {
                }

                ,768: {
                }
            }

            ,autoHeight: !0,autoWidth:!1,animateOut:"owl-fadeUp-out",animateIn:"owl-fadeUp-in",navRewind:!0,center:!1,dotsEach:1,dotData:!1,lazyLoad:!1,smartSpeed:600,fluidSpeed:5e3,navSpeed:600,dotsSpeed:600
        }

        ),e(".slider-testimonials > .owl-carousel").owlCarousel( {
            rtl: s,autoplay:3e3,autoplaySpeed:500,autoplayTimeout:5e3,dragEndSpeed:400,autoplayHoverPause:!0,loop:!0,slideBy:1,margin:30,stagePadding:0,nav:!1,dots:!1,navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsive: {
                0: {
                    items:1
                }

                ,480: {
                    items: 1
                }

                ,768: {
                    items: 1
                }

                ,1200: {
                    items: 1
                }
            }

            ,autoHeight: !1,autoWidth:!1,navRewind:!0,center:!1,dotsEach:1,dotData:!1,lazyLoad:!1,smartSpeed:600,fluidSpeed:5e3,navSpeed:400,dotsSpeed:400
        }

        ),e(".slider-img-bg .owl-item > li").each(function() {
            var a=e(this),t=a.find(".slide").children("img").attr("src");a.prepend("<div class='bg-element'></div>");var i=a.find("> .bg-element");i.css("background-image","url('"+t+"')")}

        ),r(),function() {
            e("#form-cta-subscribe-2").validate( {
                rules: {
                    cs2Name: {
                        required:!0,minlength:3
                    }

                    ,cs2Email: {
                        required:!0,email:!0
                    }

                    ,cs2PhoneNum: {
                        required:!0,number:!0,minlength:12,maxlength:12
                    }
                }
            }

            );var a=e(".cs-notifications").data("error-msg"),t=a||"Please Follow Error Messages and Complete as Required";e("#form-cta-subscribe-2").on("submit",function(a) {
                if(a.isDefaultPrevented()) {
                    var i='<i class="cs-error-icon fa fa-close"></i>'+t;u(!1,i),d()}

                else a.preventDefault(),s=e("#cs2Name").val(),n=e("#cs2Email").val(),o=e("#cs2PhoneNum").val(),e.ajax( {
                    type: "POST",url:"./php/cs2-process.php",data:"cs2Name="+s+"&cs2Email="+n+"&cs2PhoneNum="+o,success:function(a) {
                        var t,i;
                        "success"==a?(t=e(".cs-notifications").data("success-msg"),i=t||"Thank you for your submission :)",e("#form-cta-subscribe-2")[0].reset(),u(!0,'<i class="cs-success-icon fa fa-check"></i>'+i),e(".cs-notifications-content").addClass("sent"),e(".cs-notifications").css("opacity",0),e(".cs-notifications").slideDown(300).animate( {
                            opacity: 1
                        }

                        ,300).delay(5e3).slideUp(400)):(d(),u(!1,a))}
                }

                );var s,n,o}

            )}

        (),c()}

    ),e(window).on("load",function() {
        o(),function() {
            e("<div class='style-switcher'></div>").insertAfter("#full-container"),e("<link href='css/skins/preview/skin-default.css' rel='stylesheet'>").appendTo(e("head"));e(".style-switcher").load("switcher.html",function() {
                e(this).append("<img class='dp-img' src='/lead_assets/images/files/style-switcher/img-1.jpg'>"),setTimeout(function() {
                    e(".style-switcher").addClass("show"),e(".ss-icon").toggleClass("rotating")}

                ,0),e(".demos-preview li a").each(function() {
                    var a=e(this);a.hover(function() {
                        var t=a.find("img").attr("src");e(".dp-img").attr("src",t).toggleClass("appeared")}

                    )}

                ),e(".ss-icon").on("click",function(a) {
                    a.preventDefault(),e(".style-switcher").toggleClass("show"),e(this).toggleClass("rotating")}

                ),e(".colors-skins li button").each(function() {
                    e(this).on("click",function() {
                        e("[href*='css/skins/preview']").attr("href","css/skins/preview/skin-"+e(this).attr("class")+".css"),e(".colors-skins li button").removeClass("active"),e(this).addClass("active")}

                    )}

                ),e(".switch-button").each(function() {
                    e(this).on("click",function() {
                        e(this).toggleClass("active"),e(this).next().toggleClass("active"),e(this).prev().toggleClass("active")}

                    ),e(this).prev("span").on("click",function() {
                        e(this).addClass("active"),e(this).nextAll().removeClass("active")}

                    ),e(this).next("span").on("click",function() {
                        e(this).addClass("active"),e(this).prev(".switch-button").addClass("active").prevAll("span:first-child").removeClass("active")}

                    )}

                ),e(".page-width-option .switch-button").each(function() {
                    e(this).on("click",function() {
                        e("body").toggleClass("boxed")}

                    ),e(this).prev("span").on("click",function() {
                        e("body").removeClass("boxed")}

                    ),e(this).next("span").on("click",function() {
                        e("body").addClass("boxed")}

                    )}

                );var a=document.querySelector(".style-switcher-content");SimpleScrollbar.initEl(a)}

            )}

        ()}

    ),e(window).on("resize",function() {
        r(),t(),i(),o()}

    ),e(window).on("scroll",function() {
        c(),l()}

    ),e(window).on("load",function() {
        e(window).on("scroll",function() {
        }

        )}

    );(e=jQuery.noConflict())(window),e(this);var a=e("body");function t() {
        jRespond([ {
            label: "smallest",enter:0,exit:479
        }

        , {
            label: "handheld",enter:480,exit:767
        }

        , {
            label: "tablet",enter:768,exit:991
        }

        , {
            label: "laptop",enter:992,exit:1199
        }

        , {
            label: "desktop",enter:1200,exit:1e4
        }

        ]).addFunc([ {
            breakpoint: "desktop",enter:function() {
                a.addClass("device-lg")
            }

            ,exit: function() {
                a.removeClass("device-lg")
            }
        }

        , {
            breakpoint: "laptop",enter:function() {
                a.addClass("device-md")
            }

            ,exit: function() {
                a.removeClass("device-md")
            }
        }

        , {
            breakpoint: "tablet",enter:function() {
                a.addClass("device-sm")
            }

            ,exit: function() {
                a.removeClass("device-sm")
            }
        }

        , {
            breakpoint: "handheld",enter:function() {
                a.addClass("device-xs")
            }

            ,exit: function() {
                a.removeClass("device-xs")
            }
        }

        , {
            breakpoint: "smallest",enter:function() {
                a.addClass("device-xxs")
            }

            ,exit: function() {
                a.removeClass("device-xxs")
            }
        }

        ])}

    function i() {
        e(".fullscreen, #home-header, #home-banner").css("height",e(window).height()),e("#banner.fullscreen").css("height",e(window).height())}

    e(".banner-parallax").each(function() {
        var a=e(this).data("banner-height"),t=e(this).find(".row > [class*='col-']");e(this).css("min-height",a),e(t).css("min-height",a)}

    );var s,n=e("html").css("direction");function o() {
        e(function() {
            (a.hasClass("device-lg")||a.hasClass("device-md")||a.hasClass("device-sm"))&&e.stellar( {
                horizontalScrolling: !1,verticalOffset:0,responsive:!0
            }

            )}

        )}

    function c() {
        e(window).scrollTop();e(window).scrollTop()>800?e(".scroll-top-icon").addClass("show"): e(".scroll-top-icon").removeClass("show")
    }

    function l() {
        var a=e(document).height()-e(window).height(),t=e(document).scrollTop()/(a/100);e("#scroll-progress .scroll-progress").width(t+"%"),e(".scroll-percent").text(t.toFixed(0)+"%")}

    function r() {
        e(".slider-img-bg").each(function() {
            var a=e(this).closest("div").height();e(".banner-parallax").children(".banner-slider").length,e(this).find(".owl-item > li .slide").children("img").css( {
                display: "none",height:a,opacity:0
            }

            )}

        )}

    function d() {
        e(".cs-notifications").css("opacity",0),e(".cs-notifications").slideDown(300).animate( {
            opacity: 1
        }

        ,300),e(".cs-notifications-content").removeClass("sent")}

    function u(a,t) {
        var i;i="shake animated",e(".cs-notifications").delay(300).addClass(i).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function() {
            e(this).removeClass("shake bounce animated")}

        ),e(".cs-notifications").children(".cs-notifications-content").html(t)}

    s="rtl"==n,e(".scroll-top").on("click",function(a) {
        a.preventDefault(),e("html, body").animate( {
            scrollTop: 0
        }

        ,1200,"easeInOutExpo")}

    ),e(".popup-btn, .popup-bg, .popup-close").on("click",function(a) {
        a.preventDefault(),e(".popup-preview").toggleClass("viewed"),e("body").toggleClass("scroll-lock")}

    ),e(".scroll-to").on("click",function(a) {
        a.preventDefault();var t=e(this);e("html, body").stop().animate( {
            scrollTop: e(t.attr("href")).offset().top
        }

        ,1200,"easeInOutExpo")}

    ),e("#form-cta-subscribe-1").ajaxChimp( {
        callback: function(a) {
            var t=e(".cs-notifications");
            "success"===a.result?(e(".signup-form")[0].reset(),t.children(".cs-notifications-content").html('<i class="cs-success-icon fa fa-check"></i>'+a.msg).addClass("sent shake animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function() {
                e(this).removeClass("shake bounce animated")}

            ),t.css("opacity",0),t.slideDown(300).animate( {
                opacity: 1
            }

            ,300).delay(8e3).slideUp(400)):"error"===a.result&&(t.children(".cs-notifications-content").html('<i class="cs-error-icon fa fa-close"></i>'+a.msg).removeClass("sent").addClass("bounce animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function() {
                e(this).removeClass("shake bounce animated")}

            ),t.css("opacity",0),t.slideDown(300).animate( {
                opacity: 1
            }

            ,300))}

        ,url: "https://themeforest.us12.list-manage.com/subscribe/post?u=271ee03ffa4f5e3888d79125e&amp;id=163f4114e2"
    }

    )}

(jQuery);