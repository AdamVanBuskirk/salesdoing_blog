<?php
get_header();
 ?>

<div class="center" style='margin-top:40px;'>
  <?php get_template_part( 'parts/adsense-header' ); ?>
</div>

<div class="container mt-40 mb-40">

<?php
$cat = get_category( get_query_var( 'cat' ) );
?>
<?php
  while(have_posts()) {
    the_post(); 
    $authorId = get_the_author_meta('ID'); 
    $authorFirstName = get_the_author_meta('first_name');
    $authorLastName = get_the_author_meta('last_name');
    $avatar = get_avatar($authorId, $size = 100, $default = '', $alt = "Post author: " . $authorFirstName . " " . $authorLastName, $args = array(
        'class' => 'avatar-post-list'
    ));
    ?>

    <?php if ($count % 3 == 0) : ?>
      <?php if ($count != 0) : ?>
      </div>
      <?php endif; ?>
      <div class="row">
    <?php endif;
    $count++; 
    
      if ( false !== get_the_post_thumbnail_url() ) {
        $image = get_the_post_thumbnail_url(null, 'category-image'); 
      } else {
        if( function_exists( 'z_taxonomy_image_url' ) ) :
          $image = z_taxonomy_image_url( $cat->id );
        endif;
      }
      ?>
        <div id="parent-category-page-cards" class="col-md-4 card" style='border:0px;'>
          <div id="category-page-cards" class="row" style='min-height:250px;'>
            <div class="row card-image" style="padding:0px;margin:0px;">
              <?php if ($image !== false) { ?>
                <a href='<?php echo get_permalink(); ?>' style='margin:0;padding:0;'>
                  <img style='margin:0px;padding:0px;height:180px;min-width:100%;object-fit:cover;' src='<?php echo esc_url( $image ); ?>' />
                </a>
              <?php } else { ?>
                <a href='<?php echo get_permalink(); ?>' style='margin:0;padding:0;color:#efefef;'>
                  <div style='margin:0px;padding:0px;height:180px;min-width:100%;background-color:#efefef;'>&nbsp;</div>
                </a>
              <?php } ?>
              <?php
              get_template_part("parts/vote-badge");
              ?>
              <div style='float:left;position:relative;top:-40px;left:10px;'>
                <?php echo $avatar; ?> 
                <div style='display:inline-block;position:relative;top:20px;font-size:12pt;color:#000;'>
                  <div style='float:left;font-weight:bold;color:gray;'><?php echo $authorFirstName . " " . $authorLastName ?></div>
                  <div style='float:right;color:gray;'>&nbsp;on&nbsp;<?php the_time('n/j/y'); ?></div>
                </div>
              </div>
            </div>
            <div id="cat-page-title" class="row card-content" style='padding:20px;position:relative;top:-40px;'>
              <h2 class='color-black'>
                <a href='<?php echo get_permalink(); ?>' style='text-decoration: none !important; color: #000 !important;'>
                  <?php echo wp_kses_post( get_the_title() ); ?>
                </a>
              </h2>
              <?php echo get_the_category_list(', '); ?> <br/>
            </div>
          </div>
        </div>
  <?php }
  ?>
  </div><!-- row -->
  <div style='text-align:center;margin-bottom:40px;'>
    <?php
    echo paginate_links(
      array(
        'prev_text' => __(' Previous'),
        'next_text' => __('Next '),
      )
    );
    ?>
  </div>
</div>

<?php get_footer(); ?>