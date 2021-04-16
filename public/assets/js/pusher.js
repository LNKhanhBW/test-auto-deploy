$(document).ready(function () {
    var pusherKey = $('#pusher-key').val();
    var pusher = new Pusher(pusherKey, { encrypted: true, cluster: 'ap1'});
    var channel = pusher.subscribe('pusher-laravel');

    channel.bind('App\\Events\\Noti', function (data) {
        $('#noti-panel').append('<div class="card shadow mb-1"><div class="card-body">' + data.message + '</div></div>')
    });

    $('#btn-send').click(function () {
        var content = $('#content').val();
        $.post('/notification', {
            _token: $('#token').val(),
            content
        }
        );
        $('#content').val('');
    })
});
