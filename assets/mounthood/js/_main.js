(function() {
    "use strict";
    window.TRX_UTILS_STORAGE = {
        "ajax_url": "#",
        "ajax_nonce": "03969b8efa",
        "site_url": "#",
        "user_logged_in": "0",
        "email_mask": "^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$",
        "msg_ajax_error": "Invalid server answer!",
        "msg_error_global": "Invalid field's value!",
        "msg_name_empty": "The name can't be empty",
        "msg_email_empty": "Too short (or empty) email address",
        "msg_email_not_valid": "E-mail address is invalid",
        "msg_text_empty": "The message text can't be empty",
        "msg_send_complete": "Send message complete!",
        "msg_send_error": "Transmit failed!",
        "login_via_ajax": "1"
    };

    window.MOUNTHOOD_STORAGE = {
        "system_message": {
            "message": "",
            "status": "",
            "header": ""
        },
        "theme_font": "\"Open Sans\",sans-serif",
        "theme_color": "#070707",
        "theme_bg_color": "#ffffff",
        "strings": {
            "error_global": "Global error text",
            "name_empty": "The name can&#039;t be empty",
            "name_long": "Too long name",
            "email_empty": "Too short (or empty) email address",
            "email_long": "Too long email address",
            "email_not_valid": "Invalid email address",
            "subject_empty": "The subject can&#039;t be empty",
            "subject_long": "Too long subject",
            "text_empty": "The message text can&#039;t be empty",
            "text_long": "Too long message text",
            "send_complete": "Send message complete!",
            "send_error": "Transmit failed!",
            "geocode_error": "Geocode was not successful for the following reason:",
            "googlemap_not_avail": "Google map API not available!"
        },
        "ajax_url": "#",
        "ajax_nonce": "03969b8efa",
        "site_url": "#",
        "site_protocol": "http",
        "vc_edit_mode": "",
        "accent1_color": "#004eb3",
        "accent1_hover": "#3c3c3c",
        "slider_height": "100",
        "user_logged_in": "",
        "toc_menu": null,
        "toc_menu_home": "",
        "toc_menu_top": "",
        "menu_fixed": "",
        "menu_mobile": "1024",
        "menu_hover": "slide_line",
        "button_hover": "fade",
        "input_hover": "default",
        "demo_time": "0",
        "media_elements_enabled": "1",
        "ajax_search_enabled": "1",
        "ajax_search_min_length": "3",
        "ajax_search_delay": "200",
        "css_animation": "1",
        "menu_animation_in": "fadeIn",
        "menu_animation_out": "fadeOut",
        "popup_engine": "magnific",
        "email_mask": "^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$",
        "contacts_maxlength": "1000",
        "comments_maxlength": "1000",
        "remember_visitors_settings": "",
        "admin_mode": "",
        "isotope_resize_delta": "0.3",
        "error_message_box": null,
        "viewmore_busy": "",
        "video_resize_inited": "",
        "top_panel_height": "0"
    };

    jQuery(document).ready(function(jQuery) {
        jQuery.datepicker.setDefaults({
            "closeText": "Close",
            "currentText": "Today",
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesShort": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "nextText": "Next",
            "prevText": "Previous",
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "dateFormat": "MM d, yy",
            "firstDay": 1,
            "isRTL": false
        });
    });
})();

var woocommerce_price_slider_params = {
    "currency_symbol": "$",
    "currency_pos": "left",
    "min_price": "",
    "max_price": ""
};

var wc_single_product_params = {
    "i18n_required_rating_text": "Please select a rating",
    "review_rating_required": "yes"
};

var booked_js_vars = {
    "ajax_url":"#",
    "profilePage":"","publicAppointments":"",
    "i18n_confirm_appt_delete":"Are you sure you want to cancel this appointment?",
    "i18n_please_wait":"Please wait ...",
    "i18n_wrong_username_pass":"Wrong username\/password combination.",
    "i18n_fill_out_required_fields":"Please fill out all required fields.",
    "i18n_guest_appt_required_fields":"Please enter your name to book an appointment.",
    "i18n_appt_required_fields":"Please enter your name, your email address and choose a password to book an appointment.",
    "i18n_appt_required_fields_guest":"Please fill in all \"Information\" fields.",
    "i18n_password_reset":"Please check your email for instructions on resetting your password.",
    "i18n_password_reset_error":"That username or email is not recognized."
};