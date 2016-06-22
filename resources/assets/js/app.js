/**
 * Created by wojciech on 08/06/16.
 */

$('.images-container').imagesLoaded(function () {
    $('.images-container').isotope({
        itemSelector: '.gallery-item'
    });
});
