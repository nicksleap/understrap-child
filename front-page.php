<?php
/**
 * Template Name: Front Page Template
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

    <?php  
      $cities = get_posts( array(
        'post_type' => 'city', 
        'posts_per_page' => 10
      ) );

      if ( !empty( $cities ) ) {
        echo '<h2 class="mt-5">Available cities</h2>';
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';

        foreach ( $cities as $post ) {
          setup_postdata( $post );
          get_template_part( 'loop-templates/card', 'city' );
        }

        echo '</div>'; // .row
      }

      wp_reset_postdata();
     
      $re = get_posts( array(
        'post_type' => 'real_estate', 
        'posts_per_page' => 10
      ) );

      if ( !empty( $re ) ) {
        echo '<h2 class="mt-5">Real Estate</h2>';
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
        foreach ( $re as $post ) {
          setup_postdata( $post );
          get_template_part( 'loop-templates/card', 'real_estate' );
        }
        echo '</div>'; // .row
      }

      wp_reset_postdata();
    ?>

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_template_part( 'template-parts/form', 'add_re' );
get_footer();
