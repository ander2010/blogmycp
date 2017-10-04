<?php
/**
 * Single Room type Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/awebooking/single-room-type/room-type-thumbnails.php.
 *
 * @author 		Awethemes
 * @package 	AweBooking/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $room_type;

$attachment_ids = $room_type->get_gallery_ids();
if ( empty( $attachment_ids ) ) {
	return;
}
?>

<section class="carousel slide mbr-section-nopadding mbr-after-navbar"
         data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false" data-interval="5000"
         id="slider-9" style="height: 400px;">
    <div>
        <div>
            <div>
                <ol class="carousel-indicators">
                    <?php $cont = 0; ?>
                    <?php
                    if ( $attachment_ids && has_post_thumbnail() ) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            $active = '';
                            if ($cont == 0) $active = 'active';
                            ?>
                                <li data-app-prevent-settings="" data-target="#slider-9" data-slide-to="<?php echo $cont; ?>" class="<?php echo $active; ?>"></li>
                            <?php
                            //$image = wp_get_attachment_image( $attachment_id, 'awebooking_thumbnail' );

                            //echo apply_filters( 'awebooking/single_room_type_image_thumbnail_html', $image ); // WPCS: xss ok.
                            $cont++;
                        }
                    }
                    ?>
                </ol>
                <div class="carousel-inner" role="listbox">

                    <?php $cont = 0; ?>
                    <?php
                    if ( $attachment_ids && has_post_thumbnail() ) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            $active = '';
                            if ($cont == 0) $active = 'active';

                            $image = wp_get_attachment_image( $attachment_id, 'awebooking_thumbnail' );
                            $image = wp_get_attachment_image_src($attachment_id, 'awebooking_thumbnail');
                            ?>
                            <div class="mbr-section mbr-section-hero carousel-item dark center <?php echo $active; ?>"
                                 data-bg-video-slide="false"
                                 style="background-image: url(<?php echo $image[0]; ?>); height: 400px;">
                                <div class="mbr-table-cell">
                                </div>
                            </div>
<!--                            <li data-app-prevent-settings="" data-target="#slider-9" data-slide-to="0" class="--><?php //echo $active; ?><!--"></li>-->
                            <?php


                            //echo apply_filters( 'awebooking/single_room_type_image_thumbnail_html', $image ); // WPCS: xss ok.
                            $cont++;
                        }
                    }
                    ?>
                </div>

<!--                <a data-app-prevent-settings="" class="left carousel-control" role="button" data-slide="prev"-->
<!--                   href="#slider-9">-->
<!--                    <span class="icon-prev" aria-hidden="true"></span>-->
<!--                    <span class="sr-only">Previous</span>-->
<!--                </a>-->
<!--                <a data-app-prevent-settings="" class="right carousel-control" role="button" data-slide="next"-->
<!--                   href="#slider-9">-->
<!--                    <span class="icon-next" aria-hidden="true"></span>-->
<!--                    <span class="sr-only">Next</span>-->
<!--                </a>-->
            </div>
        </div>
    </div>
</section>
