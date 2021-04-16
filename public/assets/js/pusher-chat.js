$(document).ready(function () {
    var pusherKey = $('#pusher-key').val();
    var pusher = new Pusher(pusherKey, { encrypted: true, cluster: 'ap1'});
    var channel = pusher.subscribe('pusher-laravel');
    var sessionID = channel.pusher.sessionID;
    channel.bind('App\\Events\\Chat', function (data) {
        if (data.sessionID != sessionID) {
            showMessage(data.message, 'replies');
        }
    });

    $('#btn-send').click(function () {
        var message = $('#message').val();
        if ($.trim(message) == '') {
            alert('Message is required!');
            $('#message').focus();
            return false;
        }
        $.post('/chat', {
            _token: $('#token').val(),
            sessionID,
            message
        }
        );
        showMessage(message, 'sent');
    });

    function showMessage(message, type) {
        $(`<li class=${type}><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>${message}</p></li>`).appendTo($('.messages ul'));
        $('#message').val(null);
        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
    }
    $(window).on('keydown', function(e) {
        if (e.which == 13) {
            $('#btn-send').click();
            return false;
        }
    });
});
