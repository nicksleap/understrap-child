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

$hero_bg_url = 'https://placehold.co/1200x400';

if ( has_post_thumbnail() ) {
  $hero_bg_url = get_the_post_thumbnail_url( $post->ID, 'full');
}

?>
<div class="hero hero--city" style="<?php printf( 'background: url(\'%s\') center no-repeat;', $hero_bg_url )?>"></div>
<div class="wrapper" id="single-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
    <?php 
      the_title('<h1>', '</h1>');
      the_content();

      $args = array(
        'post_type'      => 'real_estate',
        'meta_query'     => array(
          array(
            'key'     => 'selected_city', 
            'value'   => $post->ID, 
            'compare' => '=',
            'type'    => 'NUMERIC'
          )
        ),
        'posts_per_page' => 10,
        'paged'          => ( get_query_var('paged') ) ? get_query_var('paged') : 1 
      );

      $res = get_posts($args);

      if ( !empty( $res )  && is_array( $res ) ) :
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
        foreach ( $res as $post ) {
          setup_postdata( $post );
          get_template_part( 'loop-templates/card', 'real_estate' );
        }
        echo '</div>'; // .row
      endif;
      

      $big = 999999999;
      echo paginate_links(array(
        'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'  => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total'   => $wp_query->max_num_pages
      ));

      wp_reset_postdata();

    ?>

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
