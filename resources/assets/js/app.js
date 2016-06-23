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