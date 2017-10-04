<?php

function mytheme_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'footer_copy' , array(
        'default'   => '@2017',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_setting( 'footer_contact_email' , array(
        'default'   => 'example@ex.com',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_setting( 'footer_contact_phone' , array(
        'default'   => '+1 (0) 000 0000 001',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_setting( 'footer_contact_address' , array(
        'default'   => '1234 Street Name, City AA 99999',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_section( 'mytheme_footer' , array(
        'title'      => __( 'Footer', 'hl' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_control( 'footer_copy', array(
        'label' => __( 'Copyright' ),
        'type' => 'textarea',
        'section' => 'mytheme_footer',
    ) );
    $wp_customize->add_control( 'footer_contact_email', array(
        'label' => __( 'Email de contacto' ),
        'type' => 'text',
        'section' => 'mytheme_footer',
    ) );
    $wp_customize->add_control( 'footer_contact_phone', array(
        'label' => __( 'Teléfono' ),
        'type' => 'text',
        'section' => 'mytheme_footer',
    ) );
    $wp_customize->add_control( 'footer_contact_address', array(
        'label' => __( 'Dirección' ),
        'type' => 'textarea',
        'section' => 'mytheme_footer',
    ) );
}
add_action( 'customize_register', 'mytheme_customize_register' );