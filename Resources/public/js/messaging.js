var sendMessageSuccess = function(data)
{
    $('.messages-list').append(data.html);

    $('form.odiseo_messaging_message textarea').removeAttr("disabled");
    $('form.odiseo_messaging_message button').removeAttr("disabled");
    $('form.odiseo_messaging_message textarea').val("");
};

var sendMessageSubmit = function(e)
{
    e.preventDefault();

    var form = $(this);
    form.ajaxSubmit({
        success : sendMessageSuccess
    });

    //Preload
    $('form.odiseo_messaging_message textarea').attr("disabled", "disabled");
    $('form.odiseo_messaging_message button').attr("disabled", "disabled");

    return false;
};

$(function()
{
    $("form.odiseo_messaging_message").submit(sendMessageSubmit);
});