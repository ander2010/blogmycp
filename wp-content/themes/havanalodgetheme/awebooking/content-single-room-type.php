<?php
/**
 * The template for displaying room_type content in the single-room_type.php template
 *
 * This template can be overridden by copying it to yourtheme/awebooking/content-single-room_type.php.
 *
 * @author        Awethemes
 * @package    AweBooking/Templates
 * @version     1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: xss ok.
    return;
}
?>

<?php
/**
 * awebooking/before_single_room_type_summary hook.
 *
 * @hooked abkng_show_room_type_images - 20
 */
?>
<section class="mbr-section mbr-section-hero mbr-section-full header2 mbr-parallax-background mbr-after-navbar"
         id="header2-r"
         style="background-image: url(<?php do_action('awebooking/before_single_room_type_summary'); ?>);">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);">
    </div>

    <div class="mbr-table mbr-table-full">
        <div class="mbr-table-cell">

            <div class="container">
                <div class="mbr-section row">
                    <div class="mbr-table-md-up">


                        <div class="mbr-table-cell col-md-5 content-size text-xs-center text-md-right">

                            <div class="summary entry-summary">

                                <?php
                                /**
                                 * awebooking/single_room_type_summary hook.
                                 *
                                 * @hooked abkng_template_single_title - 5
                                 * @hooked abkng_template_single_price - 10
                                 * @hooked abkng_template_single_form - 15
                                 * @hooked abkng_template_single_excerpt - 20 TODO
                                 * @hooked abkng_template_single_meta - 40 TODO
                                 * @hooked abkng_template_single_sharing - 50 TODO
                                 */
                                do_action('awebooking/single_room_type_summary');
                                ?>

                            </div><!-- .summary -->

                        </div>
                        <div class="mbr-table-cell mbr-valign-top mbr-left-padding-md-up col-md-7 image-size">
                            <?php do_action('awebooking/room_type_thumbnails'); ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="mbr-arrow mbr-arrow-floating hidden-sm-down" aria-hidden="true"><a href="#content6-w"><i
                    class="mbr-arrow-icon"></i></a></div>

</section>

<section class="mbr-section article mbr-section__container" id="content6-w"
         style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 lead">
                <blockquote>
                    <?php the_content(); ?>
                </blockquote>
            </div>
        </div>
    </div>
</section>


<section class="mbr-section mbr-section__container article" id="header3-t"
         style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2"><?php _e('FACILIDADES', 'hl'); ?></h3>
            </div>
        </div>
    </div>
</section>

<section class="mbr-cards mbr-section mbr-section-nopadding" id="features4-s"
         style="background-color: rgb(255, 255, 255);">
    <div class="mbr-cards-row row">
        <?php do_action('awebooking/room_type_amenities', $room_type); ?>
    </div>
</section>


<!--<div id="room-type---><?php //the_ID(); ?><!--" --><?php //post_class( 'awebooking-room-type' ); ?><!-->
<!--	<div class="awebooking-room-type__wrapper">-->
<!---->
<!--		<div class="awebooking-room-type__header">-->
<!--			--><?php
//				abkng_template_single_title();
//				abkng_template_single_price();
//			?>
<!--		</div>-->
<!---->
<!--		<div class="awebooking-room-type__media">-->
<!---->
<!--			--><?php
//
//
//			?>
<!--		</div>-->
<!---->
<!--	</div>-->
<!---->
<!--	<div class="awebooking-room-type__tabs">-->
<!--		--><?php
//			/**
//			 * awebooking/after_single_room_type_summary hook.
//			 *
//			 * @hooked abkng_output_room_type_data_tabs - 10
//			 */
//			do_action( 'awebooking/after_single_room_type_summary' );
//		?>
<!--	</div>-->
<!---->
<!--</div><!-- #room-type---><?php //the_ID(); ?>
<!---->
<?php //do_action( 'awebooking/after_single_room_type' ); ?>
