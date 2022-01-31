var emailField = null;
var emailPrompt = "Yay, your email here!";

$(window).bind("load", function() {
    emailField = $("#mce-EMAIL");

    emailField.focus(function() {
        if (emailField.val().trim() == emailPrompt) {
            emailField.val("");
            emailField.removeClass("inactive");
        }
    });

    emailField.blur(function() {
        if (emailField.val().trim() == "") {
            emailField.val(emailPrompt);
            emailField.addClass("inactive");
        }
    });
});
