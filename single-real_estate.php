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

      if (function_exists( 'get_field' )):
        $photos = get_field('photos');
        if (!empty($photos) && is_array($photos)) {
          echo '<div class="galery row">';
          foreach($photos as $photo) {
            printf(
              '<div class="galery-item col-md-3">%s</div>',
              wp_get_attachment_image( $photo['ID'], 'full', false, [
                'loading' => 'lazy',
                'class'   => 'rounded img',
                'width'   => null,
                'height'  => null
              ] )
            );
          }
          echo '</div>';
        }

        the_title('<h1>', '</h1>');
        echo '<hr>';
        the_content();
        echo '<hr>';
        
        $city = get_post_meta( $post->ID, 'selected_city', true );
        if (!empty($city)) {
          printf('<p>%s : <b>%s</b></p>', __('City'), get_the_title( $city ));
        }

        $address = get_field('address');
        if (!empty($address)) {
          printf('<p>%s : <b>%s</b></p>', __('Adress'), $address);
        }

        $area = get_field( 'area' );
        if (!empty($area)) {
          printf('<p>%s : <b>%sm<sup>2</sup></b></p>', __('Area'), $area);
        }

        $price = get_field('price');
        if (!empty($price)) {
          printf('<p>%s : <b>%s</b></p>', __('Price'), $price);
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
