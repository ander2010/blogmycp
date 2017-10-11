<?php get_header(); ?>
<?php global $post; ?>
<section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-17" style="background-image: url(<?php echo get_field('imagen_principal',$post->ID) ?>); padding-top: 100px; padding-bottom: 100px;">

    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(34, 34, 34);">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2"><?php the_title(); ?></h3>
                <div class="lead"><p><?php _e('Autor:'); ?> <?php  echo get_field('autor',$post->ID); ?></p></div>

            </div>
        </div>
    </div>

</section>

<section class="mbr-section article mbr-section__container" id="content2-18" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 lead"><blockquote><?php echo WPGlobus_Filters::filter__text($post->post_content); ?></blockquote></div>
        </div>
    </div>

</section>
<section class="mbr-section mbr-section__container" id="buttons1-19" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="text-xs-center"><a class="btn btn-primary" href="<?php echo get_permalink(122); ?>"><?php _e('VER TODAS LAS EXPERIENCIAS') ?></a> </div>
            </div>
        </div>
    </div>

</section>

<?php get_footer(); ?>
