<?php
function show_most_recent() {
    wp_reset_query(); 

    $count  = 0;
    $titles = array();
    $images = array();
    $slugs  = array();

    $args = array(
      'posts_per_page' => 6
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
    <div class="category_tile_row">
      <h1 style='font-size:16pt;font-size: 1.4em !important;font-weight:bold;' class='mb-2'>
      MOST RECENT POSTS
      </h1>
    </div>
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
  <?php
  } // show_category_tiles()