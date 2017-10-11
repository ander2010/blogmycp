<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 *
 * Template Name: Reservation Page
 */

get_header(); ?>
<?php if (get_field('page_header')): ?>
    <section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-13" style="background-image: url(<?php echo get_field('page_header'); ?>); padding-top: 60px; padding-bottom: 50px;">

        <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(34, 34, 34);">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-xs-center">
                    <h3 class="mbr-section-title display-3"><?php the_title(); ?></h3>
                </div>
            </div>
        </div>

    </section>

<?php endif; ?>
<section class="container p-t-3 m-b-3">
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
    ?>
</section>


<?php get_footer(); ?>
