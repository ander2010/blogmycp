<?php
/**
 * The Template for displaying check availability page.
 *
 * This template can be overridden by copying it to yourtheme/awebooking/check-availability.php.
 *
 * @author 		Awethemes
 * @package 	AweBooking/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $results;
get_header( 'booking' ); ?>

	<?php
		/**
		 * awebooking/before_main_content hook.
		 *
		 * @hooked abkng_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'awebooking/before_main_content' );
	?>
	<div class="awebooking-container">
		<div class="awebooking-check-availability">
			<div class="awebooking-check-availability__sidebar">

				<?php dynamic_sidebar( 'awebooking-sidebar' ); ?>
			</div>

			<div class="awebooking-check-availability__content-area">

				<?php if ( $errors ) : ?>
					<div class="awebooking-notice">
						<?php print $errors; // WPCS: xss ok. ?>
					</div>
				<?php endif; ?>

				<?php if ( isset( $results ) && $results ) : ?>

					<?php abkng_room_type_loop_start(); ?>

						<?php foreach ( $results as $post => $result ) : ?>
							<?php
								$post = get_post( $post );

								// You'll need to use the variable name $post specifically (not another variable name) in setup_postdata().
								setup_postdata( $post );
							?>
							<?php abkng_get_template_part( 'content', apply_filters( 'awebooking/content_loop_layout', 'room-type' ) ); ?>

						<?php endforeach; // end of the loop.
							wp_reset_postdata(); ?>

					<?php abkng_room_type_loop_end(); ?>

					<?php
						/**
						 * awebooking/after_archive_loop hook.
						 *
						 * @hooked abkng_pagination - 10
						 */
						do_action( 'awebooking/after_archive_loop' );
					?>
				<?php else : ?>

					<?php abkng_get_template( 'loop/no-room-types-found.php' ); ?>

				<?php endif; ?>
			</div>
		</div>
	</div>

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
