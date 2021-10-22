var ajaxRevslider;

jQuery(document).ready(function() {
    "use strict";
    // CUSTOM AJAX CONTENT LOADING FUNCTION
    ajaxRevslider = function(obj) {

        var content = "";

        data = {};

        data.action = 'revslider_ajax_call_front';
        data.client_action = 'get_slider_html';
        data.token = '2f275fdf79';
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

var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
var htmlDivCss = ".tp-caption.slider_3_slide_text_100,.slider_3_slide_text_100{color:rgba(255,238,0,1.00);font-size:100px;line-height:100px;font-weight:700;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px 0px 0px 0px;border-radius:0px 0px 0px 0px;letter-spacing:0.013em !important}.tp-caption.slider_3_text_80,.slider_3_text_80{color:rgba(255,238,0,1.00);font-size:80px;line-height:80px;font-weight:400;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px 0px 0px 0px;border-radius:0px 0px 0px 0px;letter-spacing:0.008em !important}.tp-caption.slider_3_text_70,.slider_3_text_70{color:rgba(255,255,255,1.00);font-size:70px;line-height:70px;font-weight:400;font-style:normal;font-family:Montserrat;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px 0px 0px 0px;border-radius:0px 0px 0px 0px;letter-spacing:0.008em !important}";
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
        e.c = jQuery('#rev_slider_3_1');
        e.gridwidth = [1920];
        e.gridheight = [980];

        e.sliderLayout = "fullscreen";
        e.fullScreenAutoWidth = 'off';
        e.fullScreenAlignForce = 'off';
        e.fullScreenOffsetContainer = '';
        e.fullScreenOffset = '';
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

var revapi3;
tpj(document).ready(function() {
    "use strict";
    if (tpj("#rev_slider_3_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_3_1");
    } else {
        revapi3 = tpj("#rev_slider_3_1").show().revolution({
            sliderType: "standard",
            jsFileLocation: "js/vendor/revslider/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                }
            },
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: 1920,
            gridheight: 980,
            lazyType: "none",
            parallax: {
                type: "mouse",
                origo: "enterpoint",
                speed: 400,
                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                disable_onmobile: "on"
            },
            shadow: 0,
            spinner: "spinner0",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            fullScreenAutoWidth: "off",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            fullScreenOffset: "",
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
var htmlDivCss = unescape(".tparrows%20%7B%0A%20%20%20%20top%3A%20initial%20%21important%3B%0A%20%20%20%20bottom%3A%2010%25%3B%0A%20%20%20%20left%3A%2012.5%25%20%21important%3B%0A%7D%0A%20%20%0A.tp-rightarrow%7B%0A%20%20%20%20left%3A%2019.5%25%20%21important%3B%0A%7D%0A.tparrows%3Abefore%7B%0A%20%20%09font-family%3A%20%22fontello%22%20%21important%3B%20%0A%09font-size%3A%2038px%3B%0A%7D%0A%0A.tparrows%3Ahover%3A%3Abefore%7B%0A%20%20%20%20opacity%3A%201%20%21important%3B%0A%7D");
var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
if (htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
} else {
    var htmlDiv = document.createElement('div');
    htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
    document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
}

function revslider_showDoubleJqueryError(sliderID) {
    "use strict";
    var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
    errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
    errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
    errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
    errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
    jQuery(sliderID).show().html(errorMessage);
}


