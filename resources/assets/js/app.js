/**
 * Created by wojciech on 08/06/16.
 */

// init Isotope
var $grid = $('.images-container').isotope({
    itemSelector: '.gallery-item',
    percentPosition: true,

    transitionDuration: 0,
});

$grid.imagesLoaded().progress(function () {
    $grid.isotope('layout');
});


/*
 Favourite
 */
$('.favourite-action').on('click', function (e) {

    var $target = $(event.target);

    $.ajax({
        type: "POST",
        url: "/favourite/",
        data: {
            filename: $target.data('filename'),
            action: $target.data('action')
        },
        success: function (data) {
            if (data.error) {
                // todo handle error
            }

            // todo handle 'remove and add' better
            if (data.result == 'removed') {
                $target.data('action', 'add');
                $target.removeClass('fa-heart').addClass('fa-heart-o')
            } else if (data.result == 'added') {
                $target.data('action', 'remove');
                $target.removeClass('fa-heart-o').addClass('fa-heart')
            }
        },
        dataType: 'json'
    });
});


/*
 Voting
 */
$('.vote-action').on('click', function (e) {

    var $target = $(event.target);

    $.ajax({
        type: "POST",
        url: "/vote/",
        data: {
            filename: $target.data('filename'),
            vote: $target.data('vote')
        },
        success: function (data) {
            if (data.error) {
                // todo handle error
            }
            $('.score').html(
                data.votes_up - data.votes_down
            );

        },
        dataType: 'json'
    });
});


/*
    Comments
 */

$('.comment-adder-show-action').on('click', function(e) {

    var $target = $(event.target);
    var adderElement = $target.data('adder');

    $(adderElement).show();
});