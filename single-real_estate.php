<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
    <?php 
      the_title('<h1>', '</h1>');

      if (function_exists( 'get_field' )):
        $photos = get_field('photos');
        if (!empty($photos) && is_array($photos)) {
          echo '<div class="galery">';
          foreach($photos as $photo) {
            printf(
              '<div class="galery-item">%s</div>',
              wp_get_attachment_image( $photo['ID'], 'large', false, [
                'loading' => 'lazy'
              ] )
            );
          }
          echo '</div>';
        }

        $area = get_field( 'area' );
        if (!empty($area)) {
          printf('<p>%s : <b>%sm<sup>2</sup></b></p>', __('Area'), $area);
        }

        $price = get_field('price');
        if (!empty($price)) {
          printf('<p>%s : <b>%s</b></p>', __('Price'), $price);
        }

        $address = get_field('address');
        if (!empty($address)) {
          printf('<p>%s : <b>%s</b></p>', __('Adress'), $address);
        }

        $living_area = get_field('living_area');
        if (!empty($living_area)) {
          printf('<p>%s : <b>%sm<sup>2</sup></b></p>', __('Living area'), $living_area);
        }

        $floor = get_field('floor');
        if (!empty($floor)) {
          printf('<p>%s : <b>%s</b></p>', __('Floor'), $floor);
        }

      endif;
    ?>
	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
