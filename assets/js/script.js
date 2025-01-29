



$(document).ready(function ($) {
    console.log("Hello Dipa");
    $("#signup_form").validate({
       
        submitHandler: function (form) {

            

            console.log("AJAX test initiated!");

            var postData = $("#signup_form").serialize() + "&action=custom_plugin&param=post_data";

            $.post(ajax_obj.ajax_url, postData, function (response) {
                console.log(response);
                var data = $.parseJSON(response);
                console.log(data);
               
            });
        }
    });
});