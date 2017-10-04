<?php
/**
 * Created by PhpStorm.
 * User: ernest
 * Date: 5/12/2017
 * Time: 12:54 PM
 */

?>

<section class="mbr-footer mbr-section mbr-section-md-padding" id="contacts5-z"
         style="padding-top: 90px; padding-bottom: 90px; background-color: ghostwhite;">


    <div class="row">

        <div class="mbr-company col-xs-12 col-md-6 col-lg-3">
            <div class="mbr-company card">
                <div><p><strong><?php hl_the_custom_logo(); ?></strong></p></div>
                <ul class="list-group list-group-flush">
                    <?php if (get_theme_mod('footer_contact_phone') != "") : ?>
                        <li class="list-group-item">
                            <span class="list-group-icon"><span
                                        class="etl-icon icon-phone mbr-iconfont-company-contacts5"></span></span>
                            <span class="list-group-text"><?php echo get_theme_mod('footer_contact_phone'); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if (get_theme_mod('footer_contact_address') != "") : ?>
                        <li class="list-group-item">
                            <span class="list-group-icon"><span
                                        class="etl-icon icon-map-pin mbr-iconfont-company-contacts5"></span></span>
                            <span class="list-group-text"><?php echo get_theme_mod('footer_contact_address'); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if (get_theme_mod('footer_contact_email') != "") : ?>
                        <li class="list-group-item active">
                            <span class="list-group-icon"><span
                                        class="etl-icon icon-envelope mbr-iconfont-company-contacts5"></span></span>
                            <span class="list-group-text"><a
                                        href="mailto:<?php echo get_theme_mod('footer_contact_email'); ?>"><?php echo get_theme_mod('footer_contact_email'); ?></a></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="mbr-footer-content col-xs-12 col-md-6 col-lg-3">
            <h4>Havana Lodge</h4>
            <?php

            wp_nav_menu( array(
                    'menu'              => 'footer',
                    'theme_location'    => 'footer',
                    'container' => false,
                    'menu_class'        => ''
                )
            );

            ?>
        </div>
        <div class="mbr-footer-content col-xs-12 col-md-6 col-lg-3">
            <p><strong><?php _e('Moneda'); ?></strong></p>
            <?php echo do_shortcode("[wpcs show_flags=0 width='100%' txt_type='desc']") ?>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3" data-form-type="formoid">

            <div data-form-alert="true">
                <div hidden="" data-form-alert-success="true">Thanks for filling out form!</div>
            </div>

            <?php

            $wpad_frontend_comment_form = new wpad_frontend_comment_form();
            $id = $wpad_frontend_comment_form->get_the_selected_comment_form();
            echo do_shortcode('[comments-form id="' . $id . '"]');
            ?>

        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-y"
        style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    <?php if (get_theme_mod('footer_copy') != "") : ?>
        <div class="container">
            <p class="text-xs-center"><?php echo get_theme_mod('footer_copy'); ?></p>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_enqueue_script("jquery"); ?>

<input name="animation" type="hidden">
<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon"></i></a>
</div>
</body>
</html>