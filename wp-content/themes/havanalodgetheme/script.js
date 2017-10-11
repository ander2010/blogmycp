/**
 * Created by ernest on 5/15/2017.
 */

jQuery(document).ready(function($) {
    // jQuery('.revolution-slider .banner').revolution({
    //     delay: 9000,
    //     startwidth: 1170,
    //     startheight: 500,
    //     autoHeight:"off",
    //     fullScreenAlignForce:"off",
    //
    //     onHoverStop: "on",
    //
    //     thumbWidth: 100,
    //     thumbHeight: 50,
    //     thumbAmount: 3,
    //
    //     hideThumbsOnMobile: "on",
    //     hideBulletsOnMobile: "on",
    //     hideArrowsOnMobile: "on",
    //     hideThumbsUnderResoluition: 0,
    //
    //     hideThumbs:0,
    //     hideTimerBar:"on",
    //
    //     keyboardNavigation:"on",
    //
    //     navigationType:"off",
    //     navigationArrows:"solo",
    //     navigationStyle:"round",
    //
    //     navigationHAlign:"center",
    //     navigationVAlign:"bottom",
    //     navigationHOffset:30,
    //     navigationVOffset:30,
    //
    //     soloArrowLeftHalign:"left",
    //     soloArrowLeftValign:"center",
    //     soloArrowLeftHOffset:5,
    //     soloArrowLeftVOffset:0,
    //
    //     soloArrowRightHalign:"right",
    //     soloArrowRightValign:"center",
    //     soloArrowRightHOffset:5,
    //     soloArrowRightVOffset:0,
    //
    //     touchenabled: "on",
    //     swipe_velocity:"0.7",
    //     swipe_max_touches:"1",
    //     swipe_min_touches:"1",
    //     drag_block_vertical:"false",
    //
    //     stopAtSlide: -1,
    //     stopAfterLoops: -1,
    //     hideCaptionAtLimit: 0,
    //     hideAllCaptionAtLilmit: 0,
    //     hideSliderAtLimit: 0,
    //
    //     dottedOverlay: "none",
    //
    //     fullWidth:"on",
    //     forceFullWidth:"on",
    //     fullScreen: "off",
    //     fullScreenOffsetContainer: "#topheader-to-offset",
    //
    //     shadow: 0
    //
    // });

    jQuery(".opalhotel_check_availability button").on('click', function (s) {
        jQuery(this).html(jQuery(this).attr('data-text-loader'));
        jQuery(this).attr('type', 'buttom');
        jQuery(this).addClass('myanimated flash');
    })
});
