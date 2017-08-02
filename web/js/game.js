$(function() {
    $('[data-toggle="tooltip"]').tooltip();

    const player = window.location.pathname.replace(/\D/g,'');

    const endpoint = '/api/play/' + player;

    $('.hands .hand').click(function(e) {
        e.preventDefault();
        var handElement = $(this).find('img');
        var hand = handElement.attr('id');

        $.ajax({
            url: endpoint,
            method: 'POST',
            data: JSON.stringify({
                hand: hand,
            })
        }).done(function(response){
            var computer = response.computer.toLowerCase();

            $('.computer-hand').html('<img src="/images/' + computer + '.png" />');

            $('.outcome').html(response.outcome);

            $('.toggled').removeClass('toggled');

            handElement.addClass('toggled');
        });
    });
});