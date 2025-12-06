  
  <?php 
  function show_category_row( $slug, $title ) {
    wp_reset_query(); 
    ?>
    <div class="row justify-content-center section-container">
    <div class="col-md-12 section-div">
      <h2><?php echo strtoupper( $title ); ?></h2>
      <div class="view-all">
        <a href='<?php echo esc_url( site_url( '/category/' . $slug ) ); ?>'>View All</a>
      </div>
      <hr /> 
    </div>
  </div>
  <?php
    $args = array(
      'posts_per_page' => 3,
      'category_name'  => $slug
    );
    $query = new WP_Query( $args ); 
    ?>
    <div class="row justify-content-center card-row">
    <?php
    while ( $query->have_posts() ) :
      $query->the_post();

      if ( false !== get_the_post_thumbnail_url() ) {
        $image = get_the_post_thumbnail_url(); 
      } else {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) :
          if( function_exists( 'z_taxonomy_image_url' ) ) :
            $image = z_taxonomy_image_url( $categories[0]->term_id );
          endif;
        endif;
      }
      ?>
      <div class="col-md-4 responsive-card-width card" style=''>
        <div class="row">
          <div class="col-12 card-image">
            <img src='<?php echo esc_url( $image ); ?>' />
          </div>
        </div>
        <div class="row">
          <div class="col-12 card-content">
            <h2 class='mt-0 color-black'><?php echo wp_kses_post( get_the_title() ); ?></h2>
            <div><?php echo wp_kses_post( get_the_excerpt() ); ?></div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <?php
  } // show_category_row()

  function show_category_tiles( $slug, $title ) {
    wp_reset_query(); 

    $count  = 0;
    $titles = array();
    $images = array();
    $slugs  = array();

    $args = array(
      'posts_per_page' => 6,
      'category_name'  => $slug
    );

    $query = new WP_Query( $args ); 
    while ( $query->have_posts() ) :
      $query->the_post();
      $titles[$count] = get_the_title();
      $slugs[$count]  = get_permalink($post->ID);
      $images[$count] = get_template_directory_uri() .  '/images/no-image.png';

      if ( false !== get_the_post_thumbnail_url() ) {
        $images[$count] = get_the_post_thumbnail_url(); 
      } else {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) :
          if( function_exists( 'z_taxonomy_image_url' ) ) :
            $images[$count] = z_taxonomy_image_url( $categories[0]->term_id );
          endif;
        endif;
      }

      $count++;
    endwhile;
    ?>
    <div class="row justify-content-center category_tile_row">
      <div class="col-md-8 image-div" style="background-image:url('<?php echo $images[0]; ?>');">
        <div class="overlay">
          <a href='<?php echo esc_url( $slugs[0] ); ?>'>
              <div>
                <h2><?php echo wp_kses_post( $titles[0] ); ?></h2>
              </div>
          </a>
        </div>
      </div>
      <div class='col-md-4'>
        <div class='row'>
          <div class='col-12 home-block-mobile-mt-2 small-image-div' style="background-image:url('<?php echo $images[1]; ?>');">
            <div class="overlay">
              <a href='<?php echo esc_url( $slugs[1] ); ?>'>
                  <div>
                    <h2><?php echo wp_kses_post( $titles[1] ); ?></h2>
                  </div>
              </a>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='col-12 home-block-mobile-mt-2 small-image-div' style="background-image:url('<?php echo $images[2]; ?>');">
            <div class="overlay">
              <a href='<?php echo esc_url( $slugs[2] ); ?>'>
                  <div>
                    <h2><?php echo wp_kses_post( $titles[2] ); ?></h2>
                  </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row justify-content-center category_tile_row">
      <div class='col-md-4 home-block-mobile-mt-2 small-image-div' style="background-image:url('<?php echo $images[3]; ?>');">
        <div class="overlay">
          <a href='<?php echo esc_url( $slugs[3] ); ?>'>
              <div>
                <h2><?php echo wp_kses_post( $titles[3] ); ?></h2>
              </div>
          </a>
        </div>
      </div>
      <div class='col-md-4 home-block-mobile-mt-2 small-image-div' style="background-image:url('<?php echo $images[4]; ?>');">
        <div class="overlay">
          <a href='<?php echo esc_url( $slugs[4] ); ?>'>
              <div>
                <h2><?php echo wp_kses_post( $titles[4] ); ?></h2>
              </div>
          </a>
        </div>
      </div>
      <div class='col-md-4 home-block-mobile-mt-2 small-image-div' style="background-image:url('<?php echo $images[5]; ?>');">
        <div class="overlay">
          <a href='<?php echo esc_url( $slugs[5] ); ?>'>
              <div>
                <h2><?php echo wp_kses_post( $titles[5] ); ?></h2>
              </div>
          </a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center category_tile_row">
      <div class="col-md-12 view-all">
          <a href='<?php echo esc_url( site_url( '/category/' . $slug ) ); ?>'>
            View All
          </a>
      </div>
    </div>
  <?php
  } // show_category_tiles()

  function show_all_categories() {
    wp_reset_query(); 
    $categories = get_categories(); 
    ?>
    <div class="row justify-content-center section-container">
      <div class="col-md-12 section-div">
        <h2 class="mb-2">BY CATEGORY</h2>
      </div>
    </div>

    <div class="row category_tile_row">
      <?php
      foreach ( $categories as $category ) :
        ?>
        <div class='col-md-3 home-block-mobile-mt-2 small-image-div' style="background-image:url('<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($category->cat_ID); ?>');">
          <div class="overlay">
            <a href='<?php echo esc_url( site_url( '/category/' . $category->slug ) ); ?>'>
              <div>
                <h2><?php echo wp_kses_post( $category->name ); ?></h2>
              </div>
            </a>
          </div>
        </div>
        <?php
      endforeach;
      ?>
    </div>
    <?php
  } // show_all_categories()
