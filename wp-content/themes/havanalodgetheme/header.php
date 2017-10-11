<!DOCTYPE html>
<html>
<head>
    <!-- Site made with Mobirise Website Builder v3.12.1, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">

    <!-- Le styles -->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
    <script src="//maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCmDojZzlVMZkNntKwDZeAS9VBoPJVYBFQ
"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>
        // this is important for IEs
        var polyfilter_scriptpath = '<?php echo get_template_directory_uri() ?>/assets/poput/';
    </script>

    <?php wp_head(); ?>
</head>
<body>

<section id="menu-0">

    <nav class="navbar navbar-dropdown bg-color transparent navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <!--                        <a href="https://mobirise.com" class="navbar-logo"><img src="assets/images/hlfav-147x128.png" alt="Mobirise"></a>-->
                        <?php hl_the_custom_logo(); ?>
                        <a class="navbar-caption" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse"
                            data-target="#menu-primary">
                        <div class="hamburger-icon"></div>
                    </button>

                    <?php

                    wp_nav_menu( array(
                            'menu'              => 'exCollapsingNavbar',
                            'theme_location'    => 'header-menu',
                            'container' => false,
                            'menu_class'        => 'nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm',
                            'walker' => new WP_Bootstrap_Navwalker()
                        )
                    );
                    ?>

                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse"
                            data-target="#menu-primary">
                        <div class="close-icon"></div>
                    </button>

                </div>

                <?php
                global $wp_query;
                ?>
                <?php if ( isset($wp_query->query['post_type']) && $wp_query->query['post_type'] == 'room'): ?>
                <?php else: ?>
                    <div class="mbr-table-cell">
                        <?php do_action('hotelier_room_list_datepicker'); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </nav>

</section>