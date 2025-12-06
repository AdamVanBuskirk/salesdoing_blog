<?php
get_header();
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
 ?>

<div class="center" style='margin-top:40px;'>
  <?php get_template_part( 'parts/adsense-header' ); ?>
</div>

<div class="container">
  <h1 style='text-align: center;margin-top:25px;'>AI, SEO, and More!</h1>
  <!--
  <p id='home-p1'>
    Welcome to blog for the SaaS product <a href="https://wordbot.io">wordbot.io</a>. Wordbot is a 2-part SaaS, 
    with one product that offers AI-powered content creation and rewriting and another product for doing 
    competitive SEO analysis on webpages.
  </p>
  <p id='home-p2'>
      We (cofounders Adam VanBuskirk and Kevin Sims) use this blog to interact with our audience, write about
      wordbot's new features, and share the knowledge and experience we've gained from bootstrapping a SaaS
      product in the rapdily changing AI and SEO spaces. Below are the most recent 12 posts. You can also 
      jump around using the search bar and category selectors at the top of the blog. Thanks for reading.
  </p>
    -->
</div>

<div class="container mt-40 mb-40">
<?php
//$cat = get_category( get_query_var( 'cat' ) );
  wp_reset_query(); 
  $count  = 0;
  $args = array(
    'posts_per_page' => 12,
    'paged'          => $paged,
  );
  $query = new WP_Query( $args ); 

  while($query->have_posts()) {
    $query->the_post(); 
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
            <!--
            <div style="font-weight:bold;text-align:right;padding-right:20px;padding-bottom:20px;color: #34495E;font-size:24pt;line-height:1.3;">
              -->
              <?php
              /*$votes = get_field("up_down_votes");
              if ( "" != $votes ) {
                echo "$votes<span style='font-size: 12pt;color: #85929E;position:relative;top:-6px;left:10px;padding-right:20px;'>up vote(s)</span>";
              }*/
              ?>
            <!--</div>-->
          </div>
        </div>
  <?php }
  ?>
  </div><!-- row -->
  <div style='text-align:center;margin-bottom:40px;'>
    <?php
    $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
    the_posts_pagination(
      array(
       'mid_size' => 1,
       'screen_reader_text' => __( 'Posts navigation' ),
       'current' => max( 1, get_query_var('page') ),
       'total' => $query->max_num_pages
      )
    );
    wp_reset_postdata();
    ?>
  </div>
</div>

<?php get_footer(); ?>