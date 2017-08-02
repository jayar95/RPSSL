$(function() {
    $('[data-toggle="tooltip"]').tooltip();

    const player = window.location.pathname.replace(/\D/g,'');

    const endpoint = '/api/play/' + player;

    $('.hands img').click(function() {
        let hand = $(this).attr('id');

        let request = {
            method: 'POST',
            body: JSON.stringify({
                hand: hand,
            }),
        };

        fetch(endpoint, request).then((resp) => resp.json()).then((response) => {
            let computer = response.computer.toLowerCase();

            $('.computer-hand').html('<img src="/images/' + computer + '.png" />');
    
            $('.outcome').html(response.outcome);
    
            $('.toggled').removeClass('toggled');
    
            $(this).addClass('toggled');
        });
    });
});