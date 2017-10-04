<?php
/**
 * Handle request for check availability page.
 *
 * @package awebooking\controller
 */

use AweBooking\BAT\Factory;
use AweBooking\Utils\Date_Period;

$errors = '';

if ( isset( $_REQUEST['start-date'] ) && isset( $_REQUEST['end-date'] ) ) {
	// Let's start, we need your Concierge,
	// he known everything about your hotel.
	$concierge = awebooking()->make( 'concierge' );

	try {
		$booking_request = Factory::create_booking_request();
		$results = $concierge->check_availability( $booking_request );
	} catch ( InvalidArgumentException $e ) {
		$errors = esc_html__( 'Missing data, please enter the required data.', 'awebooking' );
	} catch ( LogicException $e ) {
		$errors = esc_html__( 'Period dates is invalid.', 'awebooking' );
	} catch ( Exception $e ) {
		$errors = esc_html__( 'An error occurred while processing your request.', 'awebooking' );
	}
}

// Get template check availability page.
include abkng_locate_template( 'check-availability.php' );
