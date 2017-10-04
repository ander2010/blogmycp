<?php
/**
 * Room type attributes
 *
 * Used by list_attributes() in the room type class.
 *
 * This template can be overridden by copying it to yourtheme/awebooking/single-room-type/room-type-attributes.php.
 *
 * @author        Awethemes
 * @package    Awethemes/Templates
 * @version     1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$amenities = wp_get_post_terms(get_the_ID(), 'hotel_amenity');
?>
<?php foreach ($amenities as $amenity) : ?>

    <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="card cart-block">
                <?php if (get_field('amenities_icons', $amenity)): ?>
                    <div class="card-img iconbox" style="font-size: 2.5rem;"><?php echo do_shortcode(get_field('amenities_icons', $amenity)); ?></div>
                <?php endif; ?>
                <div class="card-block">
                    <h4 class="card-title"><?php echo $amenity->name; ?></h4>
                    <p class="card-text"><?php echo $amenity->description; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
