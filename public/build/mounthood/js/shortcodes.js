function mounthood_sc_init_actions(){"use strict";setTimeout((function(){mounthood_sc_animation()}),600),jQuery("body").on("click",".show_popup_menuitem",(function(e){return mounthood_menuitems_show_popup(jQuery(this)),e.preventDefault(),!1})).on("click",".close_menuitem, .popup_menuitem",(function(e){var t=jQuery(e.target);if(t.hasClass("popup_menuitem")||t.hasClass("close_menuitem")||t.parent().hasClass("close_menuitem"))return mounthood_menuitems_hide_popup(),e.preventDefault(),!1})),mounthood_sc_init(jQuery("body").eq(0))}function mounthood_sc_resize_actions(){"use strict";mounthood_sc_sliders_resize(),mounthood_sc_equal_height()}function mounthood_sc_scroll_actions(){"use strict";mounthood_sc_animation()}function mounthood_sc_animation(){jQuery('[data-animation^="animated"]:not(.animated)').each((function(){"use strict";jQuery(this).offset().top<jQuery(window).scrollTop()+jQuery(window).height()&&jQuery(this).addClass(jQuery(this).data("animation"))}))}function mounthood_sc_init(e){window.mounthood_theme_sc_init&&mounthood_theme_sc_init(e),e.find(".sc_accordion:not(.inited)").length>0&&e.find(".sc_accordion:not(.inited)").each((function(){"use strict";var e=jQuery(this).data("active");e=isNaN(e)?0:Math.max(0,e),jQuery(this).addClass("inited").accordion({active:e,heightStyle:"content",header:"> .sc_accordion_item > .sc_accordion_title",create:function(e,t){mounthood_sc_init(t.panel),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(t.panel),t.header.each((function(){jQuery(this).parent().addClass("sc_active")}))},activate:function(e,t){mounthood_sc_init(t.newPanel),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(t.newPanel),t.newHeader.each((function(){jQuery(this).parent().addClass("sc_active")})),t.oldHeader.each((function(){jQuery(this).parent().removeClass("sc_active")}))}})})),e.find(".sc_blogger.layout_polaroid .photostack:not(.inited)").length>0&&e.find(".sc_blogger.layout_polaroid .photostack:not(.inited)").each((function(){"use strict";var e=jQuery(this),t=e.attr("id");null==t&&(t=(t="photostack_"+Math.random()).replace(".",""),e.attr("id",t)),setTimeout((function(){e.addClass("inited").parent().height("auto"),new Photostack(e.get(0),{callback:function(e){}})}),10)})),e.find(".sc_blogger .sc_scroll_horizontal .sc_scroll_wrapper:not(.inited)").length>0&&e.find(".sc_blogger .sc_scroll_horizontal .sc_scroll_wrapper:not(.inited)").each((function(){"use strict";var e=jQuery(this),t=0;e.find(".isotope_item").each((function(){t+=jQuery(this).outerWidth()})),e.addClass("inited").width(t)})),e.find(".sc_form form:not(.inited)").length>0&&e.find(".sc_form form:not(.inited)").each((function(){"use strict";jQuery(this).addClass("inited"),jQuery(this).submit((function(e){return mounthood_sc_form_validate(jQuery(this)),e.preventDefault(),!1})),jQuery(this).find(".js__datepicker").length>0&&jQuery(this).find(".js__datepicker").pickadate({onOpen:function(){jQuery("pre").css("overflow","hidden")},onClose:function(){jQuery("pre").css("overflow","")},monthsShort:["Jan","Feb","Mar","Apr","May","June","July","Aug","Sept","Oct","Nov","Dec"],showMonthsShort:!0,format:"dd.mm.yyyy",formatSubmit:"yyyy-mm-dd",min:!0}),jQuery(this).find(".js__timepicker").length>0&&jQuery(this).find(".js__timepicker").pickatime()})),e.find(".sc_countdown:not(.inited)").length>0&&e.find(".sc_countdown:not(.inited)").each((function(){"use strict";jQuery(this).addClass("inited");jQuery(this).attr("id");var e=new Date,t=e.getFullYear()+"-"+(e.getMonth()<9?"0":"")+(e.getMonth()+1)+"-"+(e.getDate()<10?"0":"")+e.getDate()+" "+(e.getHours()<10?"0":"")+e.getHours()+":"+(e.getMinutes()<10?"0":"")+e.getMinutes()+":"+(e.getSeconds()<10?"0":"")+e.getSeconds(),i=jQuery(this).data("date"),s=i.split("-"),n=jQuery(this).data("time"),a=n.split(":");a.length<3&&(a[2]="00"),t<i+" "+n?jQuery(this).find(".sc_countdown_placeholder").countdown({until:new Date(s[0],s[1]-1,s[2],a[0],a[1],a[2]),tickInterval:1,onTick:mounthood_countdown}):jQuery(this).find(".sc_countdown_placeholder").countdown({since:new Date(s[0],s[1]-1,s[2],a[0],a[1],a[2]),tickInterval:1,onTick:mounthood_countdown})})),e.find(".sc_googlemap:not(.inited)").length>0&&e.find(".sc_googlemap:not(.inited)").each((function(){"use strict";if(!(jQuery(this).parents("div:hidden,article:hidden").length>0)){var e=jQuery(this).addClass("inited"),t=e.attr("id"),i=e.data("zoom"),s=e.data("style"),n=[];e.find(".sc_googlemap_marker").each((function(){var e=jQuery(this);n.push({point:e.data("point"),address:e.data("address"),latlng:e.data("latlng"),description:e.data("description"),title:e.data("title")})})),mounthood_googlemap_init(jQuery("#"+t).get(0),{style:s,zoom:i,markers:n})}})),e.find(".sc_infobox.sc_infobox_closeable:not(.inited)").length>0&&e.find(".sc_infobox.sc_infobox_closeable:not(.inited)").addClass("inited").on("click",(function(e){"use strict";return jQuery(this).slideUp(),e.preventDefault(),!1})),e.find(".sc_intro[data-href]:not(.inited)").length>0&&e.find(".sc_intro[data-href]:not(.inited)").addClass("inited").on("click",(function(e){"use strict";var t=jQuery(this).data("href");return window.location.href=t,e.preventDefault(),!1})),e.find(".sc_matches:not(.inited)").length>0&&e.find(".sc_matches:not(.inited)").each((function(){"use strict";jQuery(this).find(".sc_matches_next .sc_matches_list .sc_match").on("click",(function(){jQuery(this).parents(".sc_matches").find(".sc_matches_current .sc_match").hide();var e=jQuery(this).data("item");jQuery(e).fadeIn()}))})),e.find(".sc_players_table:not(.inited)").length>0&&e.find(".sc_players_table:not(.inited)").addClass("inited").on("click",".sort",(function(e){"use strict";var t=jQuery(this).parents(".sc_players_table"),i=jQuery(t).attr("id"),s="asc"==jQuery(t).data("sort")?"desc":"asc";return jQuery.post(MOUNTHOOD_STORAGE.ajax_url,{action:"sort_by_points",nonce:MOUNTHOOD_STORAGE.ajax_nonce,sort:s,table:MOUNTHOOD_STORAGE["ajax_"+i]}).done((function(e){var i={};try{i=JSON.parse(e)}catch(t){i={error:MOUNTHOOD_STORAGE.ajax_error},console.log(e)}""===i.error&&(t.data("sort",s).find(".sc_table").after(i.data).remove(),mounthood_select_players_category(jQuery(t).find(".sc_players_table_category select")))})),e.preventDefault(),!1})),e.find(".sc_players_table_category:not(.inited)").length>0&&e.find(".sc_players_table_category:not(.inited)").addClass("inited").on("change",(function(){"use strict";mounthood_select_players_category(jQuery(this))})),e.find(".sc_popup_link:not(.inited)").length>0&&e.find(".sc_popup_link:not(.inited)").each((function(){var e=jQuery(this).attr("href");jQuery(this).addClass("inited").magnificPopup({type:"inline",removalDelay:500,midClick:!0,callbacks:{beforeOpen:function(){this.st.mainClass="mfp-zoom-in"},open:function(){"use strict";mounthood_sc_init(jQuery(e)),mounthood_resize_actions(),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(jQuery(e))},close:function(){}}})})),e.find(".sc_recent_news_header_category_item_more:not(.inited)").length>0&&e.find(".sc_recent_news_header_category_item_more:not(.inited)").each((function(){"use strict";jQuery(this).addClass("inited").on("click",(function(e){return jQuery(this).toggleClass("opened").find(".sc_recent_news_header_more_categories").slideToggle(),e.preventDefault(),!1}))})),e.find(".search_wrap:not(.inited)").length>0&&e.find(".search_wrap:not(.inited)").each((function(){"use strict";if(jQuery(this).addClass("inited").on("click",".search_submit",(function(e){var t=jQuery(this).parents(".search_wrap");return t.hasClass("search_state_fixed")?""!=t.find(".search_field").val()?t.find("form").get(0).submit():(t.find(".search_field").val(""),t.find(".search_results").fadeOut()):t.hasClass("search_state_opened")?""!=t.find(".search_field").val()?t.find("form").get(0).submit():t.removeClass("search_state_opened").addClass("search_state_closed").find(".search_results").fadeOut():t.removeClass("search_state_closed").addClass("search_state_opened").find(".search_field").get(0).focus(),e.preventDefault(),!1})).on("click",".search_close",(function(e){return jQuery(this).parents(".search_wrap").removeClass("search_state_opened").addClass("search_state_closed").find(".search_results").fadeOut(),e.preventDefault(),!1})).on("click",".search_results_close",(function(e){return jQuery(this).parent().fadeOut(),e.preventDefault(),!1})).on("click",".search_more",(function(e){return""!=jQuery(this).parents(".search_wrap").find(".search_field").val()&&jQuery(this).parents(".search_wrap").find("form").get(0).submit(),e.preventDefault(),!1})).on("blur",".search_field",(function(e){""!=jQuery(this).val()||jQuery(this).parents(".search_wrap").hasClass("search_state_fixed")||jQuery(this).parents(".search_wrap").removeClass("search_state_opened").addClass("search_state_closed").find(".search_results").fadeOut()})),jQuery(this).hasClass("search_ajax")){var e=null;jQuery(this).find(".search_field").keyup((function(t){var i=jQuery(this),s=i.val();e&&(clearTimeout(e),e=null),s.length>=MOUNTHOOD_STORAGE.ajax_search_min_length&&(e=setTimeout((function(){jQuery.post(MOUNTHOOD_STORAGE.ajax_url,{action:"ajax_search",nonce:MOUNTHOOD_STORAGE.ajax_nonce,text:s}).done((function(t){clearTimeout(e),e=null;var s={};try{s=JSON.parse(t)}catch(e){s={error:MOUNTHOOD_STORAGE.ajax_error},console.log(t)}""===s.error?(i.parents(".search_ajax").find(".search_results_content").empty().append(s.data),i.parents(".search_ajax").find(".search_results").fadeIn()):mounthood_message_warning(MOUNTHOOD_STORAGE.strings.search_error)}))}),MOUNTHOOD_STORAGE.ajax_search_delay))}))}})),e.find(".sc_pan:not(.inited_pan)").length>0&&e.find(".sc_pan:not(.inited_pan)").each((function(){"use strict";if(!(jQuery(this).parents("div:hidden,article:hidden").length>0)){var e=jQuery(this).addClass("inited_pan"),t=e.parent();t.mousemove((function(i){var s=e.width(),n=e.height(),a=t.width(),o=t.height(),r=t.offset();e.hasClass("sc_pan_vertical")&&e.css("top",-Math.floor((i.pageY-r.top)/o*(n-o))),e.hasClass("sc_pan_horizontal")&&e.css("left",-Math.floor((i.pageX-r.left)/a*(s-a)))})),t.mouseout((function(t){e.css({left:0,top:0})}))}})),e.find(".sc_scroll:not(.inited)").length>0&&e.find(".sc_scroll:not(.inited)").each((function(){"use strict";jQuery(this).parents("div:hidden,article:hidden").length>0||(MOUNTHOOD_STORAGE.scroll_init_counter=0,mounthood_sc_init_scroll_area(jQuery(this)))})),e.find(".sc_slider_swiper:not(.inited)").length>0&&(e.find(".sc_slider_swiper:not(.inited)").each((function(){"use strict";if(!(jQuery(this).parents("div:hidden,article:hidden").length>0)){jQuery(this).addClass("inited"),mounthood_sc_slider_autoheight(jQuery(this)),jQuery(this).parents(".sc_slider_pagination_area").length>0&&jQuery(this).parents(".sc_slider_pagination_area").find(".sc_slider_pagination .post_item").eq(0).addClass("active");var e=jQuery(this).attr("id");null==e&&(e=(e="swiper_"+Math.random()).replace(".",""),jQuery(this).attr("id",e)),jQuery(this).addClass(e),jQuery(this).find(".slides .swiper-slide").css("position","relative");var t=jQuery(this).width();0==t&&(t=jQuery(this).parent().width());var i=jQuery(this).data("slides-per-view");null==i&&(i=1);var s=jQuery(this).data("slides-min-width");null==s&&(s=50),t/i<s&&(i=Math.max(1,Math.floor(t/s)));var n=jQuery(this).data("slides-space");null==n&&(n=0),void 0===MOUNTHOOD_STORAGE.swipers&&(MOUNTHOOD_STORAGE.swipers={}),MOUNTHOOD_STORAGE.swipers[e]=new Swiper("."+e,{calculateHeight:!jQuery(this).hasClass("sc_slider_height_fixed"),resizeReInit:!0,autoResize:!0,loop:!0,grabCursor:!0,nextButton:!!jQuery(this).hasClass("sc_slider_controls")&&"#"+e+" .sc_slider_next",prevButton:!!jQuery(this).hasClass("sc_slider_controls")&&"#"+e+" .sc_slider_prev",pagination:!!jQuery(this).hasClass("sc_slider_pagination")&&"#"+e+" .sc_slider_pagination_wrap",paginationClickable:!0,autoplay:!jQuery(this).hasClass("sc_slider_noautoplay")&&(isNaN(jQuery(this).data("interval"))?7e3:jQuery(this).data("interval")),autoplayDisableOnInteraction:!1,initialSlide:0,slidesPerView:i,loopedSlides:i,spaceBetween:n,speed:600,onFirstInit:function(e){var t=jQuery(e.container);if(t.hasClass("sc_slider_height_auto")){var i=t.find(".swiper-slide").eq(1),s=i.data("height_auto");if(s>0){var n=parseInt(i.css("paddingTop")),a=parseInt(i.css("paddingBottom"));i.height(s),t.height(s+(isNaN(n)?0:n)+(isNaN(a)?0:a)),t.find(".swiper-wrapper").height(s+(isNaN(n)?0:n)+(isNaN(a)?0:a))}}},onSlideChangeStart:function(e){var t=jQuery(e.container);if(t.hasClass("sc_slider_height_auto")){var i=e.activeIndex,s=t.find(".swiper-slide").eq(i),n=s.data("height_auto");if(n>0){var a=parseInt(s.css("paddingTop")),o=parseInt(s.css("paddingBottom"));s.height(n),t.height(n+(isNaN(a)?0:a)+(isNaN(o)?0:o)),t.find(".swiper-wrapper").height(n+(isNaN(a)?0:a)+(isNaN(o)?0:o))}}},onSlideChangeEnd:function(e,t){var i=jQuery(e.container);if(i.parents(".sc_slider_pagination_area").length>0){var s=i.parents(".sc_slider_pagination_area").find(".sc_slider_pagination .post_item");mounthood_sc_change_active_pagination_in_slider(i,e.activeIndex>s.length?0:e.activeIndex-1)}}}),jQuery(this).data("settings",{mode:"horizontal"});var a=jQuery(this).find(".slides").data("current-slide");a>0&&MOUNTHOOD_STORAGE.swipers[e].slideTo(a-1),mounthood_sc_prepare_slider_navi(jQuery(this))}})),mounthood_sc_sliders_resize()),e.find(".sc_skills_item:not(.inited)").length>0&&(mounthood_sc_init_skills(e),jQuery(window).scroll((function(){mounthood_sc_init_skills(e)}))),e.find(".sc_skills_arc:not(.inited)").length>0&&(mounthood_sc_init_skills_arc(e),jQuery(window).scroll((function(){mounthood_sc_init_skills_arc(e)}))),e.find(".sc_tabs:not(.inited):not(.no_jquery_ui),.tabs_area:not(.inited)").length>0&&e.find(".sc_tabs:not(.inited):not(.no_jquery_ui),.tabs_area:not(.inited)").each((function(){"use strict";var e=jQuery(this).data("active");e=isNaN(e)?0:Math.max(0,e),jQuery(this).addClass("inited").tabs({active:e,show:{effect:"fadeIn",duration:300},hide:{effect:"fadeOut",duration:300},create:function(e,t){mounthood_sc_init(t.panel),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(t.panel),mounthood_init_isotope()},activate:function(e,t){mounthood_sc_init(t.newPanel),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(t.newPanel),mounthood_init_isotope()}})})),e.find(".sc_tabs.no_jquery_ui:not(.inited)").length>0&&e.find(".sc_tabs.no_jquery_ui:not(.inited)").each((function(){"use strict";jQuery(this).addClass("inited").on("click",".sc_tabs_titles li a",(function(e){if(!jQuery(this).parent().hasClass("sc_tabs_active")){var t=jQuery(this).parent().siblings(".sc_tabs_active").find("a").attr("href"),i=jQuery(this).attr("href");jQuery(this).parent().addClass("sc_tabs_active").siblings().removeClass("sc_tabs_active"),jQuery(t).fadeOut((function(){jQuery(i).fadeIn((function(){mounthood_sc_init(jQuery(this)),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(jQuery(this))}))}))}return e.preventDefault(),!1})),jQuery(this).find(".sc_tabs_titles li").eq(0).addClass("sc_tabs_active"),jQuery(this).find(".sc_tabs_content").eq(0).fadeIn((function(){mounthood_sc_init(jQuery(this)),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(jQuery(this))}))})),e.find(".sc_toggles .sc_toggles_title:not(.inited)").length>0&&e.find(".sc_toggles .sc_toggles_title:not(.inited)").addClass("inited").on("click",(function(){"use strict";jQuery(this).toggleClass("ui-state-active").parent().toggleClass("sc_active"),jQuery(this).parent().find(".sc_toggles_content").slideToggle(300,(function(){mounthood_sc_init(jQuery(this).parent().find(".sc_toggles_content")),window.mounthood_init_hidden_elements&&mounthood_init_hidden_elements(jQuery(this).parent().find(".sc_toggles_content"))}))})),e.find(".sc_zoom:not(.inited)").length>0&&e.find(".sc_zoom:not(.inited)").each((function(){"use strict";jQuery(this).parents("div:hidden,article:hidden").length>0||(jQuery(this).addClass("inited"),jQuery(this).find("img").elevateZoom({zoomType:"lens",lensShape:"round",lensSize:200,lensBorderSize:4,lensBorderColour:"#ccc"}))}))}function mounthood_sc_init_scroll_area(e){"use strict";if(!mounthood_check_images_complete(e)&&MOUNTHOOD_STORAGE.scroll_init_counter++<30)setTimeout((function(){mounthood_sc_init_scroll_area(e)}),200);else{e.addClass("inited");var t=e.attr("id");null==t&&(t=(t="scroll_"+Math.random()).replace(".",""),e.attr("id",t)),e.addClass(t);var i=e.parent(),s=i.attr("id");null==s&&(s=(s="scroll_wrap_"+Math.random()).replace(".",""),i.attr("id",s)),i.addClass(s);var n=e.find("#"+t+"_bar");n.length>0&&!n.hasClass(t+"_bar")&&n.addClass(t+"_bar"),e.hasClass("sc_scroll_horizontal")&&(e.find(".sc_scroll_wrapper > .sc_scroll_slide").css("width","auto"),e.find(".sc_scroll_wrapper").css("width",e.find(".sc_scroll_wrapper > .sc_scroll_slide").width()+10),e.find(".sc_scroll_wrapper > .sc_scroll_slide").css("width","100%")),void 0===MOUNTHOOD_STORAGE.swipers&&(MOUNTHOOD_STORAGE.swipers={}),MOUNTHOOD_STORAGE.swipers[t]=new Swiper("."+t,{calculateHeight:!1,resizeReInit:!0,autoResize:!0,freeMode:!0,freeModeFluid:!0,grabCursor:!0,mode:e.hasClass("sc_scroll_vertical")?"vertical":"horizontal",direction:e.hasClass("sc_scroll_vertical")?"vertical":"horizontal",slidesPerView:e.hasClass("sc_scroll")?"auto":1,nextButton:!!i.hasClass("sc_scroll_controls")&&"#"+s+" .sc_scroll_next",prevButton:!!i.hasClass("sc_scroll_controls")&&"#"+s+" .sc_scroll_prev",scrollbar:"."+t+"_bar",scrollbarHide:!0}),e.data("settings",{mode:"horizontal"})}}function mounthood_sc_prepare_slider_navi(e){"use strict";var t=null;(t=e.siblings(".sc_slider_pagination")).length>0&&t.on("click",".post_item",(function(e){var t=jQuery(this).parents(".sc_slider_pagination_area").find(".swiper-slider-container").attr("id");return MOUNTHOOD_STORAGE.swipers[t].slideTo(jQuery(this).index()+1),e.preventDefault(),!1}))}function mounthood_sc_change_active_pagination_in_slider(e,t){"use strict";var i=e.parents(".sc_slider_pagination_area").find(".sc_slider_pagination");if(0!=i.length){i.find(".post_item").removeClass("active").eq(t).addClass("active");var s=i.height(),n=i.find(".active").offset().top-i.offset().top,a=i.find(".sc_scroll_wrapper").offset().top-i.offset().top,o=i.find(".active").height();n<0?i.find(".sc_scroll_wrapper").css({transform:"translate3d(0px, 0px, 0px)","transition-duration":"0.3s"}):s<=n+o&&i.find(".sc_scroll_wrapper").css({transform:"translate3d(0px, -"+(Math.abs(a)+n-s/4)+"px, 0px)","transition-duration":"0.3s"})}}function mounthood_sc_slider_autoheight(e){"use strict";e.hasClass(".sc_slider_height_auto")&&e.find(".swiper-slide").each((function(){null==jQuery(this).data("height_auto")&&jQuery(this).attr("data-height_auto",jQuery(this).height())}))}function mounthood_sc_sliders_resize(){"use strict";var e=void 0!==arguments[0]?arguments[0]:".sc_slider_swiper.inited",t=void 0===arguments[1]||arguments[1];jQuery(e).each((function(){var e=jQuery(this).attr("id"),i=jQuery(this).width(),s=jQuery(this).data("last-width");if(isNaN(s)&&(s=0),0==s||s!=i){var n=jQuery(this).data("slides-per-view");null==n&&(n=1);var a=jQuery(this).data("slides-min-width");null==a&&(a=50),i/n<a&&(n=Math.max(1,Math.floor(i/a))),jQuery(this).data("last-width",i),MOUNTHOOD_STORAGE.swipers[e].params.slidesPerView!=n&&(MOUNTHOOD_STORAGE.swipers[e].params.slidesPerView=n,MOUNTHOOD_STORAGE.swipers[e].params.loopedSlides=n),MOUNTHOOD_STORAGE.swipers[e].onResize()}if(t&&!jQuery(this).hasClass("sc_slider_height_fixed")){var o=0;jQuery(this).find(".swiper-slide > img").length>0?(jQuery(this).find(".swiper-slide > img").each((function(){jQuery(this).height()>o&&(o=jQuery(this).height())})),jQuery(this).height(o)):"none"!=jQuery(this).find(".swiper-slide").css("backgroundImage")&&(o=Math.floor(i/16*9),jQuery(this).height(o).find(".swiper-slide").height(o))}})),jQuery(".sc_slider_pagination_area").each((function(){var e=jQuery(this).find(".sc_slider").height();e&&(jQuery(this).height(e),jQuery(this).find(".sc_slider_pagination").height(e),jQuery(this).find(".sc_slider_pagination .sc_scroll_vertical").height(e))}))}function mounthood_sc_equal_height(){"use strict";jQuery("[data-equal-height]").each((function(){var e=jQuery(this),t=e.data("equal-height");if(t){var i=0,s=[],n=0,a=0;if(e.find(t).each((function(){var e=jQuery(this);e.height("auto");var t=e.height(),o=e.offset().top;if(0==n&&(n=o),n<o){if(s.length>0){if(i>0)for(a=0;a<s.length;a++)s[a].height(i);s=[],i=0}n=o}t>i&&(i=t),s.push(e)})),s.length>0&&i>0)for(a=0;a<s.length;a++)s[a].height(i)}}))}function mounthood_sc_init_skills(e){"use strict";if(0==arguments.length)e=jQuery("body");var t=jQuery(window).scrollTop()+jQuery(window).height();e.find(".sc_skills_item:not(.inited)").each((function(){var e=jQuery(this),i=e.offset().top;if(t>i){e.addClass("inited");var s=e.parents(".sc_skills").eq(0),n=s.data("type"),a="pie"==n&&s.hasClass("sc_skills_compact_on")?e.find(".sc_skills_data .pie"):e.find(".sc_skills_total").eq(0),o=parseInt(a.data("start")),r=parseInt(a.data("stop")),d=parseInt(a.data("max")),c=Math.round(o/d*100),_=Math.round(r/d*100),l=a.data("ed"),u=parseInt(a.data("duration")),h=parseInt(a.data("speed")),f=parseInt(a.data("step"));if("bar"==n){var m=s.data("dir"),p=e.find(".sc_skills_count").eq(0);"horizontal"==m?p.css("width",c+"%").animate({width:_+"%"},u):"vertical"==m&&p.css("height",c+"%").animate({height:_+"%"},u),mounthood_sc_animate_skills_counter(o,r,h-("unknown"!=m?5:0),f,l,a)}else if("counter"==n)mounthood_sc_animate_skills_counter(o,r,h-5,f,l,a);else if("pie"==n){var g=parseInt(a.data("steps")),O=a.data("bg_color"),y={segmentShowStroke:!0,segmentStrokeColor:a.data("border_color"),segmentStrokeWidth:1,percentageInnerCutout:parseInt(a.data("cutout")),animationSteps:g,animationEasing:a.data("easing"),animateRotate:!0,animateScale:!1},j=[];a.each((function(){var e=jQuery(this).data("color"),t=parseInt(jQuery(this).data("stop")),i=Math.round(t/d*100);j.push({value:i,color:e})})),1==a.length&&(mounthood_sc_animate_skills_counter(o,r,Math.round(1500/g),f,l,a),j.push({value:100-_,color:O}));var v=e.find("canvas");v.attr({width:e.width(),height:e.width()}).css({width:e.width(),height:e.height()}),new Chart(v.get(0).getContext("2d")).Doughnut(j,y)}}}))}function mounthood_sc_animate_skills_counter(e,t,i,s,n,a){"use strict";e=Math.min(t,e+s),a.text(e+n),e<t&&setTimeout((function(){mounthood_sc_animate_skills_counter(e,t,i,s,n,a)}),i)}function mounthood_sc_init_skills_arc(e){"use strict";if(0==arguments.length)e=jQuery("body");e.find(".sc_skills_arc:not(.inited)").each((function(){var e=jQuery(this);e.addClass("inited");var t=e.find(".sc_skills_data .arc"),i=e.find(".sc_skills_arc_canvas").eq(0),s=e.find(".sc_skills_legend").eq(0),n=Math.round(e.width()-s.width()),a=Math.floor(n/2),o={random:function(e,t){return Math.floor(Math.random()*(t-e+1)+e)},diagram:function(){var s=Raphael(i.attr("id"),n,n),r=Math.round(n/2/t.length),d=r,c=Math.round(((n-20)/2-d)/t.length),_=Math.round(n/9/t.length),l=400;s.circle(a,a,Math.round(n/2)).attr({stroke:"none",fill:MOUNTHOOD_STORAGE.theme_bg_color?MOUNTHOOD_STORAGE.theme_bg_color:"#ffffff"});var u=s.text(a,a,e.data("caption")).attr({font:Math.round(.75*d)+'px "'+MOUNTHOOD_STORAGE.theme_font+'"',fill:MOUNTHOOD_STORAGE.theme_color?MOUNTHOOD_STORAGE.theme_color:"#909090"}).toFront();d-=Math.round(c/2),s.customAttributes.arc=function(e,t,i){var s=3.6*e,n=360==s?359.99:s,r=o.random(91,240),d=(r-n)*Math.PI/180,c=r*Math.PI/180;return{path:[["M",a+i*Math.cos(c),a-i*Math.sin(c)],["A",i,i,0,+(n>180),1,a+i*Math.cos(d),a-i*Math.sin(d)]],stroke:t}},t.each((function(t){var i=jQuery(this),n=i.find(".color").val(),a=i.find(".percent").val(),o=i.find(".text").text();d+=c,s.path().attr({arc:[a,n,d],"stroke-width":_}).mouseover((function(){this.animate({"stroke-width":r,opacity:.75},1e3,"elastic"),"VML"!=Raphael.type&&this.toFront(),u.stop().animate({opacity:0},l,">",(function(){this.attr({text:(o?o+"\n":"")+a+"%"}).animate({opacity:1},l,"<")}))})).mouseout((function(){this.stop().animate({"stroke-width":_,opacity:1},1600,"elastic"),u.stop().animate({opacity:0},l,">",(function(){u.attr({text:e.data("caption")}).animate({opacity:1},l,"<")}))}))}))}};o.diagram()}))}function mounthood_countdown(e){"use strict";for(var t=jQuery(this).parent(),i=3;i<e.length;i++){var s=(e[i]<10?"0":"")+e[i];t.find(".sc_countdown_item").eq(i-3).find(".sc_countdown_digits span").addClass("hide");for(var n=s.length-1;n>=0;n--)t.find(".sc_countdown_item").eq(i-3).find(".sc_countdown_digits span").eq(n+(3==i&&s.length<3?1:0)).removeClass("hide").text(s.substr(n,1))}}function mounthood_sc_form_validate(e){"use strict";var t=e.attr("action");if(""==t)return!1;e.find("input").removeClass("error_fields_class");var i=!1;if(!("form_custom"==e.data("formtype"))){var s=[],n={};e.find('[name="username"]').length>0&&(n={field:"username",max_length:{value:60,message:MOUNTHOOD_STORAGE.strings.name_long}},e.find('[name="username"][aria-required="true"]').length>0&&(n.min_length={value:1,message:MOUNTHOOD_STORAGE.strings.name_empty}),s.push(n)),e.find('[name="email"]').length>0&&(n={field:"email",max_length:{value:60,message:MOUNTHOOD_STORAGE.strings.email_long},mask:{value:MOUNTHOOD_STORAGE.email_mask,message:MOUNTHOOD_STORAGE.strings.email_not_valid}},e.find('[name="email"][aria-required="true"]').length>0&&(n.min_length={value:7,message:MOUNTHOOD_STORAGE.strings.email_empty}),s.push(n)),e.find('[name="subject"]').length>0&&(n={field:"subject",max_length:{value:100,message:MOUNTHOOD_STORAGE.strings.subject_long}},e.find('[name="subject"][aria-required="true"]').length>0&&(n.min_length={value:1,message:MOUNTHOOD_STORAGE.strings.subject_empty}),s.push(n)),e.find('[name="message"]').length>0&&(n={field:"message",max_length:{value:MOUNTHOOD_STORAGE.contacts_maxlength,message:MOUNTHOOD_STORAGE.strings.text_long}},e.find('[name="message"][aria-required="true"]').length>0&&(n.min_length={value:1,message:MOUNTHOOD_STORAGE.strings.text_empty}),s.push(n)),i=mounthood_form_validate(e,{error_message_show:!0,error_message_time:4e3,error_message_class:"sc_infobox sc_infobox_style_error",error_fields_class:"error_fields_class",exit_after_first_error:!1,rules:s})}return i||"#"==t||jQuery.post(t,{action:"send_form",nonce:MOUNTHOOD_STORAGE.ajax_nonce,type:e.data("formtype"),data:e.serialize()}).done((function(t){var i={};try{i=JSON.parse(t)}catch(e){i={error:MOUNTHOOD_STORAGE.ajax_error},console.log(t)}var s=e.find(".result").toggleClass("sc_infobox_style_error",!1).toggleClass("sc_infobox_style_success",!1);if(""===i.error){e.get(0).reset(),s.addClass("sc_infobox_style_success").html(MOUNTHOOD_STORAGE.strings.send_complete);var n=e.find('input[name="return_url"]');n.length>0&&""!=n.val()&&setTimeout((function(){window.location.href=n.val()}),3300)}else s.addClass("sc_infobox_style_error").html(MOUNTHOOD_STORAGE.strings.send_error+" "+i.error);s.fadeIn().delay(3e3).fadeOut()})),!i}function mounthood_select_players_category(e){var t=e.find(":selected").data("cat"),i=e.parents(".sc_players_table");"all"==t?jQuery(i).find(".sc_table tr:nth-child(n+2)").show():(jQuery(i).find(".sc_table tr:nth-child(n+2)").hide(),jQuery(i).find(".sc_table tr").each((function(){var e=jQuery(this).data("cat");null!=e&&-1!=e.indexOf(t)&&jQuery(this).show()})))}function mounthood_menuitems_show_popup(e){"use strict";if(void 0===MOUNTHOOD_STORAGE.menuitem_load)MOUNTHOOD_STORAGE.menuitem_load=!1,MOUNTHOOD_STORAGE.menuitems_list=[];else if(MOUNTHOOD_STORAGE.menuitem_load)return;if(jQuery("#page_preloader").data("bg-color",jQuery("#page_preloader").css("background-color")).css({display:"block",opacity:0,backgroundColor:"transparent"}).animate({opacity:.8},300),0==MOUNTHOOD_STORAGE.menuitems_list.length){var t=e.parents(".sc_menuitems").attr("id");MOUNTHOOD_STORAGE.menuitems_list=MOUNTHOOD_STORAGE.menuitems[t].split(",")}var i=e.attr("rel");MOUNTHOOD_STORAGE.menuitem_load=!0,jQuery.post(MOUNTHOOD_STORAGE.ajax_url,{action:"ajax_menuitem",nonce:MOUNTHOOD_STORAGE.ajax_nonce,text:i}).done((function(e){MOUNTHOOD_STORAGE.menuitem_load=!1;var t={};try{t=JSON.parse(e)}catch(i){t={error:MOUNTHOOD_STORAGE.ajax_error+"<br>"+e}}if(jQuery("#page_preloader").animate({opacity:0},500,(function(){jQuery(this).css({display:"none",backgroundColor:jQuery(this).data("bg-color")})})),""===t.error){var s=0;0==jQuery(".popup_menuitem").length?(jQuery("body").append('<div id="overlay"></div><div class="popup_menuitem"></div>'),jQuery("#overlay").fadeIn(500)):(s=500,jQuery(".popup_menuitem").fadeOut(s)),setTimeout((function(){if(jQuery(".popup_menuitem").html(t.data),jQuery(".popup_menuitem .sc_menuitems_wrap").append("<a class='close_menuitem' href='#'><span class='icon-cancel'></span></a>"),MOUNTHOOD_STORAGE.menuitems_list.length>1){for(var e=0,s=0;s<MOUNTHOOD_STORAGE.menuitems_list.length;s++)if(MOUNTHOOD_STORAGE.menuitems_list[s]===i){e=s;break}var n=(e-1+MOUNTHOOD_STORAGE.menuitems_list.length)%MOUNTHOOD_STORAGE.menuitems_list.length,a=(e+1)%MOUNTHOOD_STORAGE.menuitems_list.length;jQuery(".popup_menuitem .sc_menuitems_wrap .sc_menuitem_content").append("<a class='prev_menuitem prevnext_menuitem show_popup_menuitem' rel='"+MOUNTHOOD_STORAGE.menuitems_list[n]+"'  href='#'><span class='icon-left'></span></a><a class='next_menuitem prevnext_menuitem show_popup_menuitem' rel='"+MOUNTHOOD_STORAGE.menuitems_list[a]+"'  href='#'><span class='icon-right'></span></a>")}jQuery(".popup_menuitem").fadeIn(500)}),s)}else mounthood_message_warning(MOUNTHOOD_STORAGE.strings.search_error)}))}function mounthood_menuitems_hide_popup(){"use strict";jQuery("#overlay").fadeOut(),jQuery(".popup_menuitem").fadeOut((function(){MOUNTHOOD_STORAGE.menuitem_load=!1,MOUNTHOOD_STORAGE.menuitems_list=[],jQuery("#overlay").remove(),jQuery(this).remove()}))}