var ajaxRevslider;
jQuery(document).ready(function() {
    "use strict";
    ajaxRevslider = function(obj) {

        var content = "";

        data = {};

        data.action = 'revslider_ajax_call_front';
        data.client_action = 'get_slider_html';
        data.token = 'bd7e990421';
        data.type = obj.type;
        data.id = obj.id;
        data.aspectratio = obj.aspectratio;

        // SYNC AJAX REQUEST
        jQuery.ajax({
            type: "post",
            url: "#",
            dataType: 'json',
            data: data,
            async: false,
            success: function(ret, textStatus, XMLHttpRequest) {
                if (ret.success == true)
                    content = ret.data;
            },
            error: function(e) {
                console.log(e);
            }
        });

        // FIRST RETURN THE CONTENT WHEN IT IS LOADED !!
        return content;
    };

    // CUSTOM AJAX FUNCTION TO REMOVE THE SLIDER
    var ajaxRemoveRevslider = function(obj) {
        return jQuery(obj.selector + " .rev_slider").revkill();
    };

    // EXTEND THE AJAX CONTENT LOADING TYPES WITH TYPE AND FUNCTION
    var extendessential = setInterval(function() {
        if (jQuery.fn.tpessential != undefined) {
            clearInterval(extendessential);
            if (typeof(jQuery.fn.tpessential.defaults) !== 'undefined') {
                jQuery.fn.tpessential.defaults.ajaxTypes.push({
                    type: "revslider",
                    func: ajaxRevslider,
                    killfunc: ajaxRemoveRevslider,
                    openAnimationSpeed: 0.3
                });
            }
        }
    }, 30);
});

function revslider_showDoubleJqueryError(sliderID) {
    "use strict";
    var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
    errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
    errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
    errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
    errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
    jQuery(sliderID).show().html(errorMessage);
}

var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
var htmlDivCss = "";
if (htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
} else {
    var htmlDiv = document.createElement("div");
    htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
    document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
}

var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
var htmlDivCss = ".tp-caption.slider_2_slide_2_2,.slider_2_slide_2_2{color:rgba(195,211,0,1.00);font-size:100px;line-height:22px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_3_1,.slider_2_slide_3_1{color:rgba(255,255,255,1.00);font-size:70px;line-height:22px;font-weight:400;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_3_2,.slider_2_slide_3_2{color:rgba(195,211,0,1.00);font-size:100px;line-height:22px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_3_3,.slider_2_slide_3_3{color:rgba(255,255,255,1.00);font-size:70px;line-height:22px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_1_1,.slider_2_slide_1_1{color:rgba(255,255,255,1.00);font-size:70px;line-height:22px;font-weight:400;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_1_2,.slider_2_slide_1_2{color:rgba(195,211,0,1.00);font-size:100px;line-height:22px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_1_3,.slider_2_slide_1_3{color:rgba(255,255,255,1.00);font-size:70px;line-height:22px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_2_1,.slider_2_slide_2_1{color:rgba(255,255,255,1.00);font-size:70px;line-height:22px;font-weight:400;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.slider_2_slide_2_3,.slider_2_slide_2_3{color:rgba(255,255,255,1.00);font-size:70px;line-height:22px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}";
if (htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
} else {
    var htmlDiv = document.createElement("div");
    htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
    document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
}

/******************************************
 -	PREPARE PLACEHOLDER FOR SLIDER	-
 ******************************************/

var setREVStartSize = function() {
    try {
        var e = new Object,
            i = jQuery(window).width(),
            t = 9999,
            r = 0,
            n = 0,
            l = 0,
            f = 0,
            s = 0,
            h = 0;
        e.c = jQuery('#rev_slider_2_1');
        e.gridwidth = [1240];
        e.gridheight = [545];

        e.sliderLayout = "fullwidth";
        if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
                f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
            }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
            var u = (e.c.width(), jQuery(window).height());
            if (void 0 != e.fullScreenOffsetContainer) {
                var c = e.fullScreenOffsetContainer.split(",");
                if (c) jQuery.each(c, function(e, i) {
                    u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
            }
            f = u
        } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
        e.c.closest(".rev_slider_wrapper").css({
            height: f
        })

    } catch (d) {
        console.log("Failure at Presize of Slider:" + d)
    }
};

setREVStartSize();

var tpj = jQuery;

var revapi2;
tpj(document).ready(function() {
    "use strict";
    if (tpj("#rev_slider_2_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_2_1");
    } else {
        revapi2 = tpj("#rev_slider_2_1").show().revolution({
            sliderType: "standard",
            jsFileLocation: "js/vendor/revslider/",
            sliderLayout: "fullwidth",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                arrows: {
                    style: "uranus",
                    enable: true,
                    hide_onmobile: false,
                    hide_onleave: false,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 20,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 20,
                        v_offset: 0
                    }
                }
            },
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: 1240,
            gridheight: 545,
            lazyType: "none",
            shadow: 0,
            spinner: "spinner0",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            disableProgressBar: "on",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false,
            }
        });
    }
});

var htmlDivCss = unescape(".tparrows%20%7B%0A%20%20%20%20top%3A%20initial%20%21important%3B%0A%20%20%20%20bottom%3A%206%25%3B%0A%20%20%20%20left%3A%20initial%20%21important%3B%0A%20%20%09right%3A%2021.9%25%20%21important%3B%0A%7D%0A%20%20%0A.tp-rightarrow%7B%0A%20%20%20%20left%3A%20initial%20%21important%3B%0A%20%20%20%20right%3A%2014.6%25%20%21important%3B%0A%7D%0A.tparrows%3Abefore%7B%0A%20%20%09font-family%3A%20%22fontello%22%20%21important%3B%20%0A%09font-size%3A%2038px%3B%0A%7D%0A%0A.tparrows%3Ahover%3A%3Abefore%7B%0A%20%20%20%20opacity%3A%201%20%21important%3B%0A%7D");
var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
if (htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
} else {
    var htmlDiv = document.createElement('div');
    htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
    document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
}

var htmlDivCss = unescape("%23rev_slider_2_1%20.uranus.tparrows%20%7B%0A%20%20width%3A50px%3B%0A%20%20height%3A50px%3B%0A%20%20background%3Argba%28255%2C255%2C255%2C0%29%3B%0A%20%7D%0A%20%23rev_slider_2_1%20.uranus.tparrows%3Abefore%20%7B%0A%20width%3A50px%3B%0A%20height%3A50px%3B%0A%20line-height%3A50px%3B%0A%20font-size%3A40px%3B%0A%20transition%3Aall%200.3s%3B%0A-webkit-transition%3Aall%200.3s%3B%0A%20%7D%0A%20%0A%20%20%23rev_slider_2_1%20.uranus.tparrows%3Ahover%3Abefore%20%7B%0A%20%20%20%20opacity%3A0.75%3B%0A%20%20%7D%0A");
var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
if (htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
} else {
    var htmlDiv = document.createElement('div');
    htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
    document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
}