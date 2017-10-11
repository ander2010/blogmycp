<?php
/**
 * The Template for displaying booking informations.
 *
 * This template can be overridden by copying it to yourtheme/awebooking/booking.php.
 *
 * @author 		Awethemes
 * @package 	AweBooking/Templates
 * @version     1.0.0
 */

use AweBooking\BAT\Factory;
use AweBooking\BAT\Session_Booking_Request;
use AweBooking\Utils\Formatting;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

try {
	$room_type = Factory::create_room_from_request();

	$booking_request = Factory::create_booking_request();
	$booking_request->set_request( 'room-type', $room_type->get_id() );

	$availability = awebooking( 'concierge' )->check_room_type_availability( $room_type, $booking_request );

	Session_Booking_Request::set_instance( $booking_request );

} catch ( Exception $e ) {
	$message_error = $e->getMessage();
}

get_header( 'booking' ); ?>
<?php if (get_field('header_images')): ?>
    <section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-13" style="background-image: url(<?php echo get_field('header_images'); ?>); padding-top: 80px; padding-bottom: 80px;">

        <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(34, 34, 34);">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-xs-center">
                    <?php if (get_field('header_text')): ?>
                        <h3 class="mbr-section-title display-3"><?php the_field('header_text'); ?> <?php echo $room_type->get_title(); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </section>
<?php endif; ?>

	<?php
		/**
		 * awebooking/before_main_content hook.
		 *
		 * @hooked abkng_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'awebooking/before_main_content' );
	?>

	<?php if ( isset( $message_error ) || $availability->unavailable() ) : ?>

		<p><?php echo isset( $message_error ) ? $message_error : ''; ?></p>

	<?php else: ?>

	<div class="awebooking-informations">

		<h1 class="awebooking-informations__title"><?php printf( esc_html__( 'Booking for %s', 'awebooking' ),  $room_type->get_title() ); // WPCS: xss ok. ?></h1>

		<table class="awebooking-informations__table">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Arriving On', 'awebooking' ); ?></th>
					<th><?php esc_html_e( 'Departing On', 'awebooking' ); ?></th>
					<th><?php esc_html_e( 'Night', 'awebooking' ); ?></th>
					<th><?php esc_html_e( 'Group Size', 'awebooking' ); ?></th>
					<th><?php esc_html_e( 'Booking Cost', 'awebooking' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php print Formatting::date_format( $availability->get_check_in() ); // WPCS: xss ok. ?></td>
					<td><?php print Formatting::date_format( $availability->get_check_out() ); // WPCS: xss ok. ?></td>
					<td><?php print $availability->get_nights(); // WPCS: xss ok. ?></td>
					<td>
					<?php printf( _nx( '%s adult', '%s adults', (int) $availability->get_adults(), 'adult(s) information', 'awebooking' ), number_format_i18n( (int) $availability->get_adults() ) ); // WPCS: xss ok.?>

					<?php
						if ( $availability->get_children() ) {
							printf( _nx( ' & %s child', ' & %s children', (int) $availability->get_children(), 'child(ren) information', 'awebooking' ), number_format_i18n( (int) $availability->get_children() ) ); // WPCS: xss ok.
						}
					?>
					</td>
					<td><?php print $availability->get_price(); // WPCS: xss ok. ?></td>
				</tr>
			</tbody>
		</table>

		<div class="awebooking-informations__wrapper clearfix">
			<div class="awebooking-informations__media">
				<a href="<?php echo esc_url( get_permalink( $room_type->get_id() ) ); ?>"><?php echo get_the_post_thumbnail( $room_type->get_id() ); ?></a>
			</div>

			<div class="awebooking-informations__content">
				<?php if ( $room_type->get_extra_services() ) : ?>
				<table class="awebooking-informations__table">
					<thead>
						<tr>
							<th colspan="2" class="text-left"><?php esc_html_e( 'Extra Services', 'awebooking' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2">
								<div class="awebooking-service" id="awebooking-service">
									<form action="" id="awebooking-booking-form" class="awebooking-service__wrapper clearfix">
										<?php foreach ( $room_type->get_extra_services() as $service ) : ?>
											<?php $mandatory = ( 'mandatory' === $service->get_type()  ) ? 'checked="checked" disabled="disabled"' : ''; ?>
											<div class="awebooking-service__item">
												<input type="checkbox" id="extra_id_<?php echo esc_attr( $service->get_id() ); ?>" <?php echo esc_attr( $mandatory ); ?> name="awebooking_services[]" value="<?php echo esc_attr( $service->get_id() ); ?>">

												<label for="extra_id_<?php echo esc_attr( $service->get_id() ); ?>"><?php echo esc_html( $service->get_name() ) ?></label>
												<span><?php echo Formatting::get_extra_service_label( $service ); ?></span>

												<div class="awebooking-service__content">
													<?php if ( $service->get_description() ) : ?>
														<p><?php echo esc_html( $service->get_description() ) ?></p>
													<?php endif; ?>
												</div>
											</div>
										<?php endforeach; ?>
										<input type="hidden" name="room-type" value="<?php echo esc_attr( $room_type->get_id() ); ?>">
										<input type="hidden" name="start-date" value="<?php echo esc_attr( $availability->get_check_in()->format( 'Y-m-d' ) ); ?>">
										<input type="hidden" name="end-date" value="<?php echo esc_attr( $availability->get_check_out()->format( 'Y-m-d' ) ); ?>">
										<input type="hidden" name="children" value="<?php echo esc_attr( $availability->get_request()->get_children() ); ?>">
										<input type="hidden" name="adults" value="<?php echo esc_attr( $availability->get_request()->get_adults() ); ?>">
										<!-- <input type="submit" value="Submit"> -->
									</form>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<?php endif; ?>

				<table class="awebooking-informations__table">
					<thead>
						<tr>
							<th colspan="2"><?php echo esc_html( awebooking( 'currency' )->get_code() ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php esc_html_e( 'TOTAL COST', 'awebooking' ); ?></td>
							<td id="awebooking-total-cost"><?php print $availability->get_total_price(); ?></td>
						</tr>
					</tbody>
				</table>

				<div class="text-right">
					<?php $checkout_link = get_permalink( absint( abkng_config( 'page_checkout' ) ) ); ?>
					<a class="button" href="<?php echo esc_url( $checkout_link ); ?>"><?php esc_html_e( 'Confirm Booking', 'awebooking' ); ?></a>
				</div>
			</div>
		</div>
	</div>

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
