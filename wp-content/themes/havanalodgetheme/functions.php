<?php
/**
 * Created by PhpStorm.
 * User: ernest
 * Date: 5/12/2017
 * Time: 2:25 PM
 */

include "include/theme.php";
include "include/form-comments.php";

add_theme_support( 'post-thumbnails' );

/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
add_theme_support( 'title-tag' );

/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
add_theme_support( 'html5', array(
    'comment-form', 'comment-list'
) );

/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 100,
    'flex-height' => true,
) );


// Indicate widget sidebars can use selective refresh in the Customizer.
add_theme_support( 'customize-selective-refresh-widgets' );

function hl_scripts_with_jquery()
{
    // Register the script like this for a theme:
    wp_register_script( 'tether', get_template_directory_uri() . '/assets/tether/tether.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'smooth-scroll', get_template_directory_uri() . '/assets/smooth-scroll/smooth-scroll.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'dropdown-script', get_template_directory_uri() . '/assets/dropdown/js/script.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'jquery.touch-swipe', get_template_directory_uri() . '/assets/touch-swipe/jquery.touch-swipe.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'jquery.viewportchecker', get_template_directory_uri() . '/assets/viewport-checker/jquery.viewportchecker.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'bootstrap-carousel-swipe', get_template_directory_uri() . '/assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'masonry.pkgd', get_template_directory_uri() . '/assets/masonry/masonry.pkgd.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'imagesloaded.pkgd', get_template_directory_uri() . '/assets/imagesloaded/imagesloaded.pkgd.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'jarallax', get_template_directory_uri() . '/assets/jarallax/jarallax.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'gmap', get_template_directory_uri() . '/assets/map/gmap3.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'custom-script', get_template_directory_uri() . '/assets/theme/js/script.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'my-script', get_template_directory_uri() . '/script.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'formoid', get_template_directory_uri() . '/assets/formoid/formoid.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'player', get_template_directory_uri() . '/assets/mobirise-gallery/player.min.js', array( 'jquery' ), '20141010', true );
    wp_register_script( 'mobirise-gallery-script', get_template_directory_uri() . '/assets/mobirise-gallery/script.js', array( 'jquery' ), '20141010', true );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'tether' );
    wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'smooth-scroll' );
    wp_enqueue_script( 'dropdown-script' );
    wp_enqueue_script( 'jquery.touch-swipe' );
    wp_enqueue_script( 'jquery.viewportchecker' );
    wp_enqueue_script( 'bootstrap-carousel-swipe' );
    wp_enqueue_script( 'masonry.pkgd' );
    wp_enqueue_script( 'imagesloaded.pkgd' );
    wp_enqueue_script( 'jarallax' );
    wp_enqueue_script( 'gmap' );
    wp_enqueue_script( 'custom-script' );
    wp_enqueue_script( 'my-script' );
    wp_enqueue_script( 'formoid' );
    wp_enqueue_script( 'player' );
    wp_enqueue_script( 'mobirise-gallery-script' );


    global $wp_query;
    wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'query_vars' => json_encode( $wp_query->query )
    ));
}
add_action( 'wp_enqueue_scripts', 'hl_scripts_with_jquery' );

/*Ajax Action*/

add_action( 'wp_ajax_nopriv_ajax_page', 'my_ajax_page' );
add_action( 'wp_ajax_ajax_page', 'my_ajax_page' );

function my_ajax_page() {
    echo get_bloginfo( 'title' );
    die();
}

/**
 * Returns a custom logo, linked to home.
 *
 * @since 4.5.0
 *
 * @param int $blog_id Optional. ID of the blog in question. Default is the ID of the current blog.
 * @return string Custom logo markup.
 */
function hl_custom_logo( $blog_id = 0 ) {
    $html = '';
    $switched_blog = false;

    if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
        switch_to_blog( $blog_id );
        $switched_blog = true;
    }

    $custom_logo_id = get_theme_mod( 'custom_logo' );

    // We have a logo. Logo is go.
    if ( $custom_logo_id ) {

        list( $src, $width, $height ) = wp_get_attachment_image_src($custom_logo_id, 'full');
        $html = sprintf( '<a href="%1$s" class="navbar-logo" rel="home" itemprop="url"><img src="%2$s"></a>',
            esc_url( home_url( '/' ) ),
            $src
        );
    }

    // If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
    elseif ( is_customize_preview() ) {
        $html = sprintf( '<a href="%1$s" class="custom-logo-link" style="display:none;"><img class="custom-logo"/></a>',
            esc_url( home_url( '/' ) )
        );
    }

    if ( $switched_blog ) {
        restore_current_blog();
    }

    /**
     * Filters the custom logo output.
     *
     * @since 4.5.0
     * @since 4.6.0 Added the `$blog_id` parameter.
     *
     * @param string $html    Custom logo HTML output.
     * @param int    $blog_id ID of the blog to get the custom logo for.
     */

    return $html;
}
add_filter('get_custom_logo', 'hl_custom_logo');

if ( ! function_exists( 'hl_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     *
     * @since Twenty Fifteen 1.5
     */
    function hl_the_custom_logo() {
        if ( function_exists( 'hl_custom_logo' ) ) {
            the_custom_logo();
        }
    }
endif;

function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

require_once('include/wp-bootstrap-navwalker.php');

function add_custom_class_li(){
    return array('nav-item');
}
function add_link_menu_attr($atts){
    if ( key_exists('class',$atts) ){
        $atts['class'] = "nav-link link ".$atts['class'];
    }else{
        $atts['class'] = " nav-link link";
    }
    return $atts;
}

add_filter('nav_menu_css_class', 'add_custom_class_li');
add_filter('nav_menu_link_attributes', 'add_link_menu_attr');




