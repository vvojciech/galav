/**
 * Created by wojciech on 08/06/16.
 */

// init Isotope
var $grid = $('.images-container').isotope({
    itemSelector: '.gallery-item',
    percentPosition: true,

    transitionDuration: 0,
});

$grid.imagesLoaded().progress( function() {
    $grid.isotope('layout');
});


/*
    Favourite
 */
$('.favourite-action').on('click', function(e) {

    var $target = $( event.target );
    
    $.ajax({
        type: "POST",
        url: "/favourite/",
        data: {
            filename: $target.data('filename'),
            action: $target.data('action')
        },
        success: function (data) {
            console.log(data);
        },
        dataType: 'json'
    });
});