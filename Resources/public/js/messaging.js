(function($){

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

    var refreshMessageListDom = function(data){
        var lastItem, newMessagesDom;
       if ( data.newMessages != false){
            lastItem = $('div[data-last=true]');
            lastItem.attr('data-last', 'false')
            newMessagesDom = $(data.html).find('li');
            $('.messages-list').append(newMessagesDom);
       }
    }

    var updateMessageList = function(){
        var lastItem = $('div[data-last=true]');
        var messageSourceUrl   =  lastItem.data('sourceUrl');

        $.get( messageSourceUrl, function(data){
            console.log('succes');
        }).done(function(data) {
            refreshMessageListDom(data);
            })
            .fail(function() {

            })
            .always(function() {

            });
    };

    $(function()
    {
        $("form.odiseo_messaging_message").submit(sendMessageSubmit);
        setInterval(updateMessageList , 2000);
    });

})(jQuery);