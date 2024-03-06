<?php ?>
<div class="col">
  <div class="card">
    <?php
      if ( has_post_thumbnail() ) {
        echo get_the_post_thumbnail( $post->ID, 'full', array(
          'loading' => 'lazy',
          'class'   => 'card-img-top'
        ) );
      } else {
        echo '<img src="https://placehold.co/600x400" alt="no image">';
      }
    ?>  
    <div class="card-body">
      <?php
        the_title('<h5 class="card-title">', '</h5>');

        printf( 
          '<div class="card-text">%s</div>', 
          apply_filters( 'the_content', get_the_content('') )
        );

        printf( '<a href="%s" class="btn btn-primary">Find real estate in %s</a>', get_the_permalink(), get_the_title() )
      ?>
    </div>
  </div>
</div>