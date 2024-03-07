<div class="container mt-5">
  <form action="#" method="POST" class="ns_form row g-3">
    <?php wp_nonce_field('submit_real_estate_form', 'real_estate_nonce'); ?>
    <div>
      <input type="hidden" name="action" value="create_re">
    </div>

    <div class="col-md-9">
      <label for="title" class="form-label">Name of the Real Estate</label>
      <input require type="text" name="title" class="form-control" id="title">
    </div>
    <div class="col-md-3">
      <label for="price" class="form-label">Price</label>
      <input require type="text" name="price" class="form-control" id="price">
    </div>
    <div class="col-md-3">
      <?php
        $cities = get_posts( array(
          'post_type' => 'city', 
          'posts_per_page' => -1
        ) );
      
        if ( !empty( $cities ) ) :
          echo '<label class="form-label" for="selected_city">Choose city:</label>';
      
          if ( is_array( $cities ) ) {
            echo '<select name="selected_city" id="selected_city" class="form-select" >';
              foreach ($cities as $city) {
                printf( 
                  '<option value="%1$s">%2$s</option>',
                  $city->ID,
                  $city->post_title
                );
              }
            echo '</select>';
          }
      
        endif;
      ?>
    </div>
    <div class="col-md-9">
      <label for="address" class="form-label">Address</label>
      <input require type="text" name="address" class="form-control" id="address">
    </div>
    <div class="col-md-12">
      <label for="content" class="form-label">Short description (optional)</label>
      <textarea type="text" name="content" class="form-control" id="content"></textarea>
    </div>
    
    <div class="col-md-4">
      <label for="area" class="form-label">Area</label>
      <input type="text" name="area" class="form-control" id="area">
    </div>
    <div class="col-md-4">
      <label for="living_area" class="form-label">Living Area</label>
      <input type="text" name="living_area" class="form-control" id="living_area">
    </div>
    <div class="col-md-4">
      <label for="floor" class="form-label">Floor</label>
      <input type="text" name="floor" class="form-control" id="floor">
    </div>
    <div class="col-md-12">
      <label for="photos" class="form-label">Photos</label>
      <input type="file" name="photos[]" class="form-control" id="photos" multiple>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div class="form-response col-12"></div>
  </form>
</div>

<?php

