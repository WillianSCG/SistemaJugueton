jQuery(document).on('click', '.mega-dropdown', function(e) {
  e.stopPropagation()
})
$(function ($) {

    /*-----------------------------------------------------------------*/
    /* Animaciones del Carousel
    /*-----------------------------------------------------------------*/
    "use strict";
    function doAnimations(elems) {
        //El evento animación en una variable
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
    //Variables 
    var $immortalCarousel = $('.animate_text'),
        $firstAnimatingElems = $immortalCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    //Inicializa el carousel
    $immortalCarousel.carousel();
    //Animcion primera
    doAnimations($firstAnimatingElems);
    //Otros sliders para ser animados en una variable
    $immortalCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

})(jQuery);


