<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/awebooking/loop/view-more.php.
 *
 * @author 		Awethemes
 * @package 	AweBooking/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_check_availability_page() ) {
	return;
}

$default_args = AweBooking\Utils\Date_Utils::get_booking_request_query( array( 'room-type' => get_the_ID() ) );
$link = add_query_arg( (array) $default_args, get_the_permalink( intval( abkng_config( 'page_booking' ) ) ) );

?>
<a class="awebooking-loop-room-type__button-booking" href="<?php echo esc_url( $link ); ?>"><?php esc_html_e( 'Book Room', 'awebooking' ); ?></a>
