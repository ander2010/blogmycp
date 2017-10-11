<?php
/**
 * The template for displaying room content in the single-room.php template
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/content-single-room.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

?>

<?php
/**
 * hotelier_before_single_room hook.
 *
 * @hooked htl_print_notices - 10
 */
do_action('hotelier_before_single_room');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
global $room;
?>

<section class="mbr-section mbr-section-hero mbr-section-full header2 mbr-parallax-background mbr-after-navbar"
         id="header2-r" style="background-image: url(<?php echo get_the_post_thumbnail_url($room->id); ?>);">

    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(0, 0, 0);">
    </div>

    <div class="mbr-table mbr-table-full">
        <div class="mbr-table-cell">

            <div class="container">
                <div class="mbr-section row">
                    <div class="mbr-table-md-up">


                        <div class="mbr-table-cell col-md-4 content-size text-xs-center text-md-right">

                            <h3 class="mbr-section-title display-4 m-a-0"><?php the_title(); ?></h3>

                            <?php
                            /**
                             * hotelier_single_room_details hook.
                             *
                             * @hooked hotelier_template_single_room_datepicker - 5
                             * @hooked hotelier_template_single_room_price - 10
                             * @hooked hotelier_template_single_room_non_cancellable_info - 15
                             * @hooked hotelier_template_single_room_deposit - 20
                             * @hooked hotelier_template_single_room_min_max_info - 25
                             * @hooked hotelier_template_single_room_meta - 30
                             * @hooked hotelier_template_single_room_facilities - 40
                             * @hooked hotelier_template_single_room_conditions - 50
                             * @hooked hotelier_template_single_room_sharing - 60
                             */
                            do_action('hotelier_single_room_details');
                            ?>

                        </div>
                        <div class="mbr-table-cell mbr-valign-top mbr-left-padding-md-up col-md-8 image-size">
                            <?php $attachment_ids = $room->get_gallery_attachment_ids(); ?>
                            <?php if ($attachment_ids) : ?>
                                <section class="carousel slide mbr-section-nopadding mbr-after-navbar"
                                         data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false"
                                         data-interval="5000"
                                         id="slider-9" style="height: 400px;">
                                    <div>
                                        <div>
                                            <div>
                                                <ol class="carousel-indicators">
                                                    <?php $cont = 0; ?>
                                                    <?php foreach ($attachment_ids as $attachment_id) {

                                                        $active = '';
                                                        if ($cont == 0) $active = 'active';
                                                        ?>
                                                        <li data-app-prevent-settings="" data-target="#slider-9"
                                                            data-slide-to="<?php echo $cont; ?>"
                                                            class="<?php echo $active; ?>"></li>

                                                        <?php
                                                        $cont++;

                                                    } ?>
                                                </ol>
                                                <div class="carousel-inner" role="listbox">
                                                    <?php

                                                    if ($attachment_ids) {
                                                        $loop = 0;
                                                        ?>
                                                        <?php $cont = 0; ?>
                                                        <?php foreach ($attachment_ids as $attachment_id) {

                                                            $active = '';
                                                            if ($cont == 0) $active = 'active';

                                                            $classes = array('room__gallery-thumbnail', 'room__gallery-thumbnail--listing');

                                                            $image_large = wp_get_attachment_image_src($attachment_id, 'full');

                                                            if (!$image_large) {
                                                                continue;
                                                            }

                                                            $image_link = esc_url($image_large[0]);
                                                            $image_width = absint($image_large[1]);
                                                            $image_height = absint($image_large[2]);
                                                            $image_title = esc_attr(get_the_title($attachment_id));
                                                            $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));
                                                            $image_class = esc_attr(implode(' ', $classes));
                                                            $image_index = has_post_thumbnail() ? absint($loop + 1) : absint($loop);
                                                            ?>

                                                            <div class="mbr-section mbr-section-hero carousel-item dark center <?php echo $active; ?>"
                                                                 data-bg-video-slide="false"
                                                                 style="background-image: url(<?php echo $image_link; ?>); height: 400px;">
                                                                <div class="mbr-table-cell">
                                                                </div>
                                                            </div>

                                                            <?php
//                                                            echo apply_filters( 'hotelier_room_list_image_thumbnail_html', sprintf( '<li><a href="%s" data-size="%sx%s" data-index="%s" class="%s" title="%s">%s</a></li>', $image_link, $image_width, $image_height, $image_index, $image_class, $image_caption, $image_title ), $attachment_id, $post->ID, $image_class );

                                                            $loop++;
                                                            $cont++;
                                                        } ?>

                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php else : ?>
                                <img width="100%" src="<?php the_post_thumbnail_url('paradise-full-width'); ?>">
                            <?php endif; ?>
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
         style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 10px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 lead">
                <div class="col-xs-12">
                    <h3 class="mbr-section-title display-4"><?php _e('Descripción'); ?></h3>
                </div>
                <p><?php the_content(); ?></p>
            </div>
        </div>
    </div>

</section>

<section class="mbr-section mbr-section__container article p-b-1" id="header3-t"
         style="background-color: rgb(255, 255, 255); padding-top: 20px; ">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2"><?php _e('Facilidades'); ?></h3>
            </div>
        </div>
    </div>
</section>

<section class="mbr-cards mbr-section mbr-section-nopadding" id="features4-s"
         style="background-color: rgb(255, 255, 255);">
    <div class="mbr-cards-row row">
        <?php if (have_rows('room_facilidad', $room->id)): ?>
            <?php while (have_rows('room_facilidad', $room->id)): the_row(); ?>
                <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 30px; padding-bottom: 30px;">
                    <div class="container">
                        <div class="card cart-block">
                            <div class="card-img iconbox"
                                 style="font-size: 1.5rem;"><?php echo do_shortcode(the_sub_field('amenities_icons')); ?></div>
                            <div class="card-block">
                                <h4 class="card-title"><?php the_sub_field('fac_nombre'); ?></h4>
                                <div class="card-text"><?php the_sub_field('fac_descripcion'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
