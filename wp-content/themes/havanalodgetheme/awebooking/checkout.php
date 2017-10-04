<?php
/**
 * The Template for checkout page.
 *
 * This template can be overridden by copying it to yourtheme/awebooking/checkout.php.
 *
 * @author 		Awethemes
 * @package 	Awethemes/Templates
 * @version     1.0.0
 */

use AweBooking\AweBooking;
use AweBooking\BAT\Factory;
use AweBooking\BAT\Session_Booking_Request;
use AweBooking\Utils\Formatting;
use AweBooking\Room_Type;
use AweBooking\Utils\Mail;
use AweBooking\Mails\Booking_Created;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

try {
	$booking_request = new Session_Booking_Request;

	$room_type = new Room_Type( $booking_request->get_request( 'room-type' ) );

	$availability = awebooking( 'concierge' )->check_room_type_availability( $room_type, $booking_request );

	$extra_services = $availability->get_request()->get_request( 'extra_services' );

	$extra_services_name = [];

	foreach ( $extra_services as $key => $id ) {
		$term = get_term( $id, AweBooking::HOTEL_EXTRA_SERVICE );
		$extra_services_name[] = $term->name;
	}
} catch ( Exception $e ) {
	$message_error = $e->getMessage();
}

get_header( 'booking' ); ?>

	<?php
		/**
		 * awebooking/before_main_content hook.
		 *
		 * @hooked abkng_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'awebooking/before_main_content' );
	?>

	<?php if ( isset( $_GET['step'] ) && $_GET['step'] === 'complete' && ! empty( $_COOKIE['awebooking-booking-id'] ) ) : ?>
		<p><?php echo sprintf( esc_html__( 'Thanks for your booking. Your booking ID: #%s', 'awebooking' ), $_COOKIE['awebooking-booking-id'] ); ?></p>
	<?php endif ?>

	<?php if ( isset( $availability ) && $availability->available() ) : ?>
	<table class="awebooking-checkout-table mb-0">
		<thead>
			<tr>
				<th class="text-left awebooking-checkout-table__reservation"><?php esc_html_e( 'Reservation', 'awebooking' ); ?></th>
				<th class="text-right awebooking-checkout-table__extra-service"><?php esc_html_e( 'Extra Services', 'awebooking' ); ?></th>
				<th class="text-right awebooking-checkout-table__price"><?php esc_html_e( 'Price', 'awebooking' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2" class="text-left"><?php printf( esc_html__( '%1$s from %2$s to %3$s, %4$s night(s)', 'awebooking' ), $room_type->get_title(), Formatting::date_format( $availability->get_check_in() ), Formatting::date_format( $availability->get_check_out() ), $availability->get_nights() ); // WPCS: xss ok. ?></td>
				<td class="text-right"><?php print $availability->get_price(); // WPCS: xss ok.?></td>
			</tr>
		</tbody>
	</table>

	<div class="awebooking-checkout-table__wrapper">
		<table class="awebooking-checkout-table awebooking-checkout-table--extra float-right">
			<tbody>
				<?php if ( $extra_services_name ) : ?>
				<tr>
					<td class="text-right awebooking-checkout-table__extra-service"><?php echo esc_html( implode( $extra_services_name , ', ') ); ?></td>
					<td class="text-right awebooking-checkout-table__price"><?php print $availability->get_extra_services_price(); // WPCS: xss ok.?></td>
				</tr>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="text-right awebooking-checkout-table__extra-service awebooking-checkout-table__total"><?php esc_html_e( 'Order total', 'default' ); ?></th>
					<th class="text-right awebooking-checkout-table__price awebooking-checkout-table__total-price"><?php print $availability->get_total_price(); // WPCS: xss ok.?></th>
				</tr>
			</tfoot>
		</table>
	</div>

	<form id="awebooking-checkout-form" class="awebooking-checkout-form" method="POST">
		<div class="awebooking-billing-fields">
			<h2 class="awebooking-checkout-form__title"><?php esc_html_e( 'Booking Details', 'awebooking' ); ?></h2>

			<div class="awebooking-field form-row-first">
				<label><?php esc_html_e( 'First Name', 'awebooking' ); ?> <abbr class="required" title="required">*</abbr></label>
				<input type="text" name="awebooking[first_name]" class="awebooking-input" required="">
			</div>

			<div class="awebooking-field form-row-last">
				<label><?php esc_html_e( 'Last Name', 'awebooking' ); ?> <abbr class="required" title="required">*</abbr></label>
				<input type="text" name="awebooking[last_name]" class="awebooking-input" required="">
			</div>

			<div class="awebooking-field">
				<label><?php esc_html_e( 'Company Name', 'awebooking' ); ?></label>
				<input type="text" name="awebooking[company]" class="awebooking-input">
			</div>

			<div class="awebooking-field form-row-first">
				<label><?php esc_html_e( 'Email Address', 'awebooking' ); ?> <abbr class="required" title="required">*</abbr></label>
				<input type="email" name="awebooking[email]" class="awebooking-input" required="">
			</div>

			<div class="awebooking-field form-row-last">
				<label><?php esc_html_e( 'Phone', 'awebooking' ); ?> <abbr class="required" title="required">*</abbr></label>
				<input type="text" name="awebooking[phone]" class="awebooking-input" required="">
			</div>

		</div>

		<div class="awebooking-billing-fields awebooking-billing-fields--right">
			<h2 class="awebooking-checkout-form__title"><?php esc_html_e( 'Additional Information', 'awebooking' ); ?></h2>
			<div class="awebooking-field">
				<label><?php esc_html_e( 'Note', 'awebooking' ); ?></label>
				<textarea name="awebooking[note]"></textarea>
			</div>

			<button type="submit" class="button" data-type="awebooking"><?php esc_html_e( 'Submit', 'awebooking' ); ?></button>
		</div>
	</form>

	<?php endif ?>

	<?php
		/**
		 * awebooking/after_main_content hook.
		 *
		 * @hooked abkng_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'awebooking/after_main_content' );
	?>

<?php get_footer( 'booking' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
