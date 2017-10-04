<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>

    <!--Section Slides-->
<?php if (have_rows('slides')): ?>
    <section class="mbr-slider mbr-section mbr-section__container carousel slide mbr-section-nopadding mbr-after-navbar"
             data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false" data-interval="5000"
             id="slider-9">
        <div>
            <div>
                <div>
                    <ol class="carousel-indicators">
                        <?php $cont = 0; ?>
                        <?php while (have_rows('slides')): the_row(); ?>
                            <?php $active = ''; ?>
                            <?php if ($cont == 0) $active = 'active'; ?>
                            <li data-app-prevent-settings="" data-target="#slider-9" data-slide-to="0"
                                class="<?php echo $active; ?>"></li>
                            <?php $cont++; ?>
                        <?php endwhile; ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $cont = 0; ?>
                        <?php while (have_rows('slides')): the_row(); ?>
                            <?php $active = ''; ?>
                            <?php if ($cont == 0) $active = 'active'; ?>
                            <div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full <?php echo $active; ?>"
                                 data-bg-video-slide="false"
                                 style="background-image: url(<?php the_sub_field('imagen'); ?>);">
                                <div class="mbr-table-cell">
                                    <div class="mbr-overlay"></div>
                                    <div class="container-slide container">

                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2 text-xs-center">
                                                <h2 class="mbr-section-title display-3"><?php the_sub_field('caption'); ?></h2>
                                                <h2 class="mbr-section-title display-4"><?php the_sub_field('subtitulo'); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $cont++; ?>
                        <?php endwhile; ?>
                    </div>

                    <a data-app-prevent-settings="" class="left carousel-control" role="button" data-slide="prev"
                       href="#slider-9">
                        <span class="icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a data-app-prevent-settings="" class="right carousel-control" role="button" data-slide="next"
                       href="#slider-9">
                        <span class="icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!--<section class="mbr-section article mbr-section__container" id="content2-8">-->
<!--    <div class="container">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-xs-12 lead horizontal-form">-->
<!--                    --><?php //echo do_shortcode('[opalhotel_check_available]'); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
    <!--Intro Text-->
<?php if (get_field('text_intro')): ?>
    <section class="mbr-section article mbr-section__container" id="content2-3"
             style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">

        <div class="container">
            <div class="row">
                <div class="col-xs-12 lead">
                    <blockquote>
                        <?php echo get_field('text_intro') ?>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!--Rooms Section-->
<?php if (have_rows('rooms')): ?>
    <?php if (get_field('setion_title')): ?>
        <section class="mbr-section mbr-section__container article" id="header3-i"
                 style="background-color: rgb(255, 255, 255); padding-top: 60px; padding-bottom: 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="mbr-section-title display-2"><?php echo get_field('setion_title'); ?></h3>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="mbr-cards mbr-section mbr-section-nopadding mbr-parallax-background" id="features1-h"
             style="background-image: url(<?php echo get_field('imagen_fondo_habitaciones'); ?>);">

        <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(34, 34, 34);">
        </div>

        <div class="mbr-cards-row row striped">
            <?php while (have_rows('rooms')): the_row(); ?>
                <?php
                $roo = get_sub_field('room');


                $room = htl_get_room($roo->ID);
                $price = $room->get_min_price_html();
                ?>
                <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">
                    <div class="container">
                        <div class="card cart-block">
                            <a href="<?php echo get_the_permalink($roo); ?>">
                                <div class="card-img m-b-1"><img height="200"
                                                           src="<?php echo get_the_post_thumbnail_url($roo->ID); ?>"
                                                           class="card-img-top"></div>
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><?php echo WPGlobus_Filters::filter__text($roo->post_title); ?></h4>
                                <h3 class="card-title">
                                    <?php
                                    echo $price;
                                    ?>
                                </h3>
                                <div class="room__meta room__meta--single">
                                    <ul class="nav">
                                        <li class="nav-item"><strong><?php esc_html_e( 'Guests:', 'wp-hotelier' ); ?></strong> <?php echo absint( $room->get_max_guests() ); ?></li>
                                        <?php if ( $room->get_max_children() ) : ?>
                                            <li class="nav-item"><strong><?php esc_html_e( 'Children:', 'wp-hotelier' ); ?></strong> <?php echo absint( $room->get_max_children() ); ?></li>
                                        <?php endif; ?>
<!--                                        --><?php //echo $room->get_categories( ', ', '<li class="nav-item"><strong>' . esc_html__( 'Room type:', 'wp-hotelier' ) . '</strong> ', '</li>' ); ?>
                                    </ul>
                                </div>
                                <div class="card-btn m-t-2"><a href="<?php echo get_permalink($roo); ?>"
                                                         class="btn btn-primary"><?php _e('Reservar', 'hl'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>
    <!--Rooms Section-->
<?php /*if (have_rows('rooms')): ?>
    <?php if (get_field('setion_title')): ?>
        <section class="mbr-section mbr-section__container article" id="header3-i"
                 style="background-color: rgb(255, 255, 255); padding-top: 60px; padding-bottom: 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="mbr-section-title display-2"><?php echo get_field('setion_title'); ?></h3>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="mbr-cards mbr-section mbr-section-nopadding" id="features1-h"
             style="background-color: rgb(255, 255, 255);">
        <div class="mbr-cards-row row striped">
            <?php while (have_rows('rooms')): the_row(); ?>
                <?php
                $room = get_sub_field('room');
                $dbroom = new \AweBooking\Room_Type( $room );
                ?>
                <div class="mbr-cards-col col-xs-12 col-lg-4" style="padding-top: 80px; padding-bottom: 80px;">
                    <div class="container">

                            <div class="card cart-block">
                                <a href="<?php echo get_the_permalink( $room ); ?>"><div class="card-img"><img height="200"
                                                       src="<?php echo get_the_post_thumbnail_url($room->ID); ?>"
                                                                                                         class="card-img-top"></div> </a>
                            <div class="card-block">
                                <h4 class="card-title"><?php echo $room->post_title; ?></h4>
                                <h3 class="card-title">
                                    <?php
                                    $price = $dbroom->get_base_price();
                                    echo do_shortcode('[wpcs_price value='.$price->get_amount().']');
                                    ?>
                                </h3>

                                <p class="card-text"><?php echo $room->post_content; ?></p>
                                <div class="card-btn"><a href="<?php echo get_permalink($room); ?>"
                                                         class="btn btn-primary"><?php _e('Reservar','hl'); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

<?php endif; */ ?>

<?php if (have_rows('services')): ?>
    <?php if (get_field('section_service_title')): ?>
        <section class="mbr-section mbr-section__container article" id="header3-f"
                 style="background-color: rgb(255, 255, 255); padding-top: 60px; padding-bottom: 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="mbr-section-title display-2"><?php echo get_field('section_service_title'); ?></h3>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="mbr-cards mbr-section mbr-section-nopadding" id="features7-e"
             style="background-color: rgb(255, 255, 255);">
        <div class="mbr-cards-row row">
            <?php while (have_rows('services')): the_row(); ?>
                <div class="mbr-cards-col col-xs-12 col-lg-2" style="padding-top: 80px; padding-bottom: 80px;">
                    <div class="container">
                        <div class="card cart-block">
                            <div class="card-img iconbox">
                                <a href="#" style="color: rgb(255, 255, 255); font-size: 2em;" class="mbr-iconfont">
                                    <?php the_sub_field('icon'); ?>
                                </a>
                            </div>
                            <div class="card-block">
                                <h4 class="card-title"><?php the_sub_field('service_name'); ?></h4>

                                <p class="card-text"><?php the_sub_field('service_description'); ?></p>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>

    <!--Galeria de Imagenes-->
<?php if (have_rows('galery_images')): ?>
    <section class="mbr-section mbr-section__container article" id="header3-b"
             style="background-color: rgb(255, 255, 255); padding-top: 40px; padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php if (get_field('galery_title')): ?>
                        <h3 class="mbr-section-title display-2"><?php echo get_field('galery_title'); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="mbr-gallery mbr-section mbr-section-nopadding mbr-slider-carousel" id="gallery2-a"
             data-filter="false" style="padding-top: 2rem; padding-bottom: 6rem;">
        <!-- Filter -->

        <!-- Gallery -->
        <div class="mbr-gallery-row container">
            <div class=" mbr-gallery-layout-default">
                <div>
                    <div>
                        <?php $cont = 0; ?>
                        <?php while (have_rows('galery_images')): the_row(); ?>
                            <div class="mbr-gallery-item mbr-gallery-item__mobirise3 mbr-gallery-item--p0"
                                 data-tags="Awesome" data-video-url="false">
                                <div href="#lb-gallery2-a" data-slide-to="<?php echo $cont ?>" data-toggle="modal">


                                    <img alt="<?php the_sub_field('image_description') ?>"
                                         src="<?php the_sub_field('imagen') ?>">

                                    <span class="icon-focus"></span>

                                </div>
                            </div>
                            <?php $cont++; endwhile; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Lightbox -->
        <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1"
             data-keyboard="true" data-interval="false" id="lb-gallery2-a">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <ol class="carousel-indicators">
                            <?php $cont = 0; ?>
                            <?php while (have_rows('galery_images')): the_row(); ?>
                                <?php $active = ($cont == 0) ? 'active' : ''; ?>
                                <li data-app-prevent-settings="" data-target="#lb-gallery2-a"
                                    class="<?php echo $active; ?>"
                                    data-slide-to="<?php echo $cont; ?>"></li>
                                <?php $cont++; endwhile; ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php $cont = 0; ?>
                            <?php while (have_rows('galery_images')): the_row(); ?>
                                <?php $active = ($cont == 0) ? 'active' : ''; ?>
                                <div class="carousel-item <?php echo $active; ?>">
                                    <img alt="<?php the_sub_field('image_description') ?>"
                                         src="<?php the_sub_field('imagen') ?>">
                                </div>
                                <?php $cont++; endwhile; ?>
                        </div>
                        <a class="left carousel-control" role="button" data-slide="prev" href="#lb-gallery2-a">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" role="button" data-slide="next" href="#lb-gallery2-a">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                        <a class="close" href="#" role="button" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
<?php if (get_field('title_comments')): ?>
    <?php if (get_field('paralax_images')): ?>
        <?php $img = get_field('paralax_images') ?>
    <?php endif; ?>
    <section class="mbr-section mbr-parallax-background" id="testimonials1-5"
             style="background-image: url(<?php echo $img; ?>); padding-top: 40px; padding-bottom: 120px;">

        <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(34, 34, 34);">
        </div>

        <div class="mbr-section mbr-section__container mbr-section__container--middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-center">
                        <h3 class="mbr-section-title display-2">
                            <?php echo get_field('title_comments'); ?>
                        </h3>

                    </div>
                </div>
            </div>
        </div>


        <div class="mbr-testimonials mbr-section mbr-section-nopadding">
            <div class="container">
                <div class="row">
                    <?php
                    $wpad_frontend_comment_form = new wpad_frontend_comment_form();
                    $id = $wpad_frontend_comment_form->get_the_selected_comment_form();
                    global $post;
                    $data = $wpad_frontend_comment_form->comments_listing_enable($id, $post->ID, 3, 0, 'DESC');

                    ?>

                    <?php if (count($data['result']) > 0): ?>
                        <?php foreach ($data['result'] as $comment): ?>
                            <div class="col-xs-12 col-lg-4">

                                <div class="mbr-testimonial card mbr-testimonial-lg">
                                    <div class="card-block"><p>“<?php echo $comment['comment_content']; ?>”</p></div>
                                    <div class="mbr-author card-footer">
                                        <div class="mbr-author-name"><?php echo $comment['comment_author']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xs-12 col-lg-12 text-xs-center text-sm-center text-md-center p-y-2">
                <a class="btn btn-info btn-lg"
                   href="#contacts5-z"><?php echo do_shortcode('[icon name="pencil" class="" unprefixed_class=""]'); ?><?php _e('Dejanos tu testimonio'); ?></a>
            </div>

        </div>

    </section>
<?php endif; ?>

<?php if (get_field('map')): ?>
    <section class="mbr-section mbr-section__container article" id="header3-d"
             style="background-color: rgb(255, 255, 255); padding-top: 80px; padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php if (get_field('location_title')): ?>
                        <h3 class="mbr-section-title display-2"><?php echo get_field('location_title'); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php if (get_field('map')): ?>
        <?php $d = get_field('map'); ?>
        <section class="mbr-section mbr-section-nopadding" id="map1-c">
            <div id="bigmap" class="mbr-map" data-zoom="<?php echo get_field('zoom'); ?>"
                 data-icons="<?php echo get_field('icon_marker'); ?>" data-lng="<?php echo $d['lng']; ?>"
                 data-lat="<?php echo $d['lat']; ?>">

            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php
global $post;
$post_local = $post;
echo do_shortcode('[hl-experiencia-shortcode]');
$post = $post_local;
//$a = $post->ID;
//echo $a;
//
//$map = get_field('map');
//echo $map;
?>

    <div class="md-modal md-effect-20" id="modal-20">
        <div class="md-content">

        </div>
    </div>
    <div class="md-overlay"></div><!-- the overlay element -->

<?php get_footer(); ?>