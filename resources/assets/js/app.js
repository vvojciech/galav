/**
 * Created by wojciech on 08/06/16.
 */

$.getScript('//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.1/isotope.pkgd.js', function () {
    $('.images-container').imagesLoaded(function () {
        $('.images-container').isotope({
            itemSelector: '.gallery-item'
        });
    });
});