jQuery(document).ready(function ($) {
    console.log("Hello Dipa");
    $("#signup_form").validate({
       
        submitHandler: function (form) {

            e.preventDefault(); // Prevent form submission

        console.log("AJAX test initiated!");

            var postData = $("#signup_form").serialize() + "&action=custom_plugin&param=post_data";

            $.post(ajax_obj.ajax_url, postData, function (response) {
                if (response.success) {
                    console.log("Response Data:", response.data);
                } else {
                    console.error("Error:", response.data.message);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Request Failed:", textStatus, errorThrown);
            });
        }
    });
});