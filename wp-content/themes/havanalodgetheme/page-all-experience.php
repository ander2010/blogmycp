<?php /* Template Name: All Experience */ ?>
<?php get_header(); ?>

<?php

$args = array(
    'post_type' => 'hl_experiencia'
);

$loops = new WP_Query($args);
$fav_experience = null;
$other_experience = array();
global $post;
$thispage = $post;

while ($loops->have_posts()) {
    $loops->the_post();
    global $post;
    if (get_field('destacado',$post->ID)) {
        $fav_experience = $post;
    }else{
        $other_experience[] = $post;
    }
}

$post = $thispage;
?>

    <section class="mbr-section mbr-parallax-background mbr-after-navbar" id="msg-box5-1h" style="background-image: url(<?php echo get_field('imagen_parallax',$fav_experience->ID) ?>); padding-top: 120px; padding-bottom: 0px;">

        <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(0, 0, 0);">
        </div>
        <div class="container">
            <div class="row">
                <div class="mbr-table-md-up">



                    <div class="mbr-table-cell col-md-5 text-xs-center text-md-right content-size">
                        <h3 class="mbr-section-title display-2"><?php echo WPGlobus_Filters::filter__text($fav_experience->post_title); ?></h3>
                        <div class="lead">

                            <p><?php _e('Autor:'); ?> <?php  echo get_field('autor',$fav_experience->ID); ?></p>

                        </div>

                        <div><a class="btn btn-primary" href="<?php echo get_permalink($fav_experience->ID); ?>"><?php _e('Leer Más'); ?></a></div>
                    </div>





                    <div class="mbr-table-cell mbr-left-padding-md-up mbr-valign-top col-md-7 image-size" style="width: 50%;">
                        <div class="mbr-figure"><img src="<?php echo get_field('imagen_principal',$fav_experience->ID) ?>"></div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <section class="mbr-section mbr-section__container article" id="header3-1j" style="background-color: rgb(255, 255, 255); padding-top: 60px; padding-bottom: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="mbr-section-title display-2"><?php the_title(); ?></h3>

                </div>
            </div>
        </div>
    </section>

    <section class="mbr-cards mbr-section mbr-section-nopadding" id="features3-1f" style="background-color: rgb(255, 255, 255);">



        <div class="mbr-cards-row row">
            <?php foreach ($other_experience as $exp): ?>
                <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 0px; padding-bottom: 80px;">
                    <div class="container">
                        <div class="card cart-block">
                            <div class="card-img"><img src="<?php echo get_field('imagen_principal',$exp->ID) ?>" class="card-img-top"></div>
                            <div class="card-block">
                                <h4 class="card-title"><?php echo WPGlobus_Filters::filter__text($exp->post_title); ?></h4>
                                <h5 class="card-subtitle"><?php _e('Autor:'); ?> <?php  echo get_field('autor',$exp->ID); ?></h5>

                                <div class="card-btn"><a href="<?php echo get_permalink($exp->ID); ?>" class="btn btn-primary"><?php _e('Leer Más'); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


<?php get_footer(); ?>