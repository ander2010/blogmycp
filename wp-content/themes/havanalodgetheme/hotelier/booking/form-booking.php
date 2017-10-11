<?php
/**
 * Booking Form - Where guests will complete their reservations
 *
 * This template can be overridden by copying it to yourtheme/hotelier/booking/form-booking.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

htl_print_notices();

do_action( 'hotelier_before_booking_form', $booking );

// extensions can hook into here to add their own pages
$booking_form_url = apply_filters( 'hotelier_booking_form_url', HTL()->cart->get_booking_form_url() ); ?>

<form id="booking-form" name="booking" method="post" class="booking form--booking clearfix" action="<?php echo esc_url( $booking_form_url ); ?>" enctype="multipart/form-data">
	<div class="col-xs-4">
        <?php if ( sizeof( $booking->booking_fields ) > 0 ) : ?>

            <?php do_action( 'hotelier_booking_guest_details' ); ?>

        <?php endif; ?>
    </div>
	<div class="col-xs-4">
        <div class="col-xs-12">
            <?php do_action( 'hotelier_booking_details' ); ?>
        </div>
        <div class="col-xs-12">
            <?php
            // show additional information fields
            if ( htl_get_option( 'booking_additional_information' ) ) :	?>

                <?php do_action( 'hotelier_booking_additional_information' ); ?>

            <?php endif; ?>
        </div>

    </div>
	<div class="col-xs-4">
        <?php do_action( 'hotelier_booking_table' ); ?>

        <?php do_action( 'hotelier_booking_payment' ); ?>

        <?php do_action( 'hotelier_book_button' ); ?>
    </div>
</form>

<?php do_action( 'hotelier_after_booking_form', $booking ); ?>
