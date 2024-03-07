<?php ?>
<div class="col">
  <div class="card">
    <?php
      $photos = get_field( 'photos' );

      
      if ( !empty( $photos ) && is_array($photos) ) {
        echo wp_get_attachment_image( $photos[0]['ID'], 'full', array(
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

        echo '<div class="card-text">';
        
        $price = get_field('price');
        if (!empty($price)) {
          printf('<p>%s : <b>%s</b></p>', __('Price'), $price);
        }

        $area = get_field( 'area' );
        if (!empty($area)) {
          printf('<small>%s : <b>%sm<sup>2</sup></b></small><br/>', __('Area'), $area);
        }

        $city = get_post_meta( $post->ID, 'selected_city', true );
        if (!empty($city)) {
          printf('<small>%s : <b>%s</b></small><br/>', __('City'), get_the_title( $city ));
        }

        $address = get_field('address');
        if (!empty($address)) {
          printf('<small>%s : <b>%s</b></small><br/>', __('Adress'), $address);
        }

        $living_area = get_field('living_area');
        if (!empty($living_area)) {
          printf('<small>%s : <b>%sm<sup>2</sup></b></small><br/>', __('Living area'), $living_area);
        }

        $floor = get_field('floor');
        if (!empty($floor)) {
          printf('<small>%s : <b>%s</b></small><br/>', __('Floor'), $floor);
        }
        echo '</div>';

        printf( '<a href="%s" class="btn btn-primary mt-3">More</a>', get_the_permalink() )
      ?>
    </div>
  </div>
</div>