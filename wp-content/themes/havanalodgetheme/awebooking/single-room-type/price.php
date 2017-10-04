<?php
/**
 * Single Room type Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/awebooking/single-room-type/price.php.
 *
 * @author  Awethemes
 * @package AweBooking/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $room_type;
?>
<?php if ( $price_html = $room_type->get_price() ) : ?>
	<p class="mbr-section-title display-4"><?php printf( esc_html__( 'Start from %s / Night', 'awebooking' ), '<span>' . $price_html . '</span>'); // WPCS: xss ok. ?></p>
<?php endif; ?>

