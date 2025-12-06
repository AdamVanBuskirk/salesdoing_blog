<?php
/*function setMeta($args = NULL) {
  
  if (!$args['title']) {
    $args['title'] = "Wordbot Blog";
  }

  if (!$args['description']) {
    $args['description'] = "Welcome to our blog about AI Article Rewriting";
  }
  ?>
  <title><?php echo $args["title"]; ?></title>
  <description><?php echo $args["description"]; ?></description>
  <?php 
}*/

function wordbot_features() {
  add_theme_support('title-tag');
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'post-featured-image', 1200, 300 );
  add_image_size( 'category-image', 500, 180 );
}

add_action('after_setup_theme', 'wordbot_features');

function wordbot_files() {
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), true);
  wp_enqueue_script('main.js', get_theme_file_uri('/js/main.js'), array('jquery'), '2.0', true);
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
  wp_enqueue_style('theme-style', get_theme_file_uri('/css/style.css'),'','1.9');
}

add_action('wp_enqueue_scripts', 'wordbot_files');

// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

add_action('init', 'tags_support_all');

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

add_action('pre_get_posts','tags_support_query');

function excerpt_more_link($more) {
  global $post;
  return '... <a class="more-link" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'excerpt_more_link');

//ADDING THE READ MORE LINK TO ALL OTHER EXCERPTS
add_filter( 'get_the_excerpt', 'excerpt_read_more_all_cases' );

function excerpt_read_more_all_cases( $text ) {

	global $post;
	$raw = $post->post_content;
	$excerpt_length = apply_filters( 'excerpt_length', 55 );
	$raw_to_more = substr( $raw, 0, strpos( $raw, '<!--more-->' ) );
	$excerpt_of_raw = wp_trim_words( $raw, $excerpt_length, ''); 
	$excerpt_of_raw_to_more = wp_trim_words( $raw_to_more, $excerpt_length, ''); 

// CHECKING FOR MANUALLY WRITTEN EXCERPT
	if( has_excerpt() ) { 
		$text .= '... <a class="more-link" href="'. get_permalink($post->ID) . '">' . __( 'Read More', 'textdomain' ) . '</a>';
		
// CHECKING FOR EXCERPT BEING SHORT BY THE 'MORE TAG'
	} elseif( strpos( $raw, '<!--more-->' ) && strlen( $excerpt_of_raw_to_more ) < strlen( $excerpt_of_raw ) ) {
	
		$text .= '... <a class="more-link" href="'. get_permalink($post->ID) . '">' . __( 'Read More', 'textdomain' ) . '</a>';
		
// CHECKING FOR EXCERPT BEING SHORT BECAUSE OIF SHORT CONTENT
	} elseif( strlen( $text ) == strlen( $excerpt_of_raw ) ) {
	
		$text .= '... <a class="more-link" href="'. get_permalink($post->ID) . '">' . __( 'Read More', 'textdomain' ) . '</a>';
		
	}
	
	return $text;
}

/*add_filter( 'posts_search_orderby', 'my_posts_search_orderby', 10, 2 );
function my_posts_search_orderby( $orderby, $query ) {
    if ( $query->is_main_query() && is_search() ) {
        global $wpdb;
        $orderby = "post_date desc";
    }

    return $orderby;
}*/
add_action('pre_get_posts', 'filter_query_orderby');
function filter_query_orderby( $query ) {

  // do not modify queries in the admin
  if (is_admin()) {
    return $query;
  }

  $query->set('orderby', 'post_date desc');

  if ($query->is_main_query()) {  
    if ("" !== get_query_var('sort')) { 
      $sort = $query->query_vars['sort'];
      if ("votes" == $sort) {
        $query->set('meta_key', 'up_down_votes');
        $query->set('orderby', 'meta_value_num');
        $query->set('meta_type', 'NUMERIC');
        $query->set('order', 'DESC');
      }
    }
  }
  return $query;
}

add_action('init','add_get_val');
function add_get_val() { 
    global $wp; 
    $wp->add_query_var('sort');
}

add_action('wp_ajax_newsletter_signup', 'newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'newsletter_signup');

function newsletter_signup() {

  $list_id = '0cc6e044a2';
  $mck = '5f5dcbbbd16317f4b76cbd60ce1e5718-us21';
  
  // The data to send to the API
  $data = array(
      "email_address" => $_POST["email"],
      "status" => "subscribed",
  );

  // Setup cURL
  $ch = curl_init('https://us21.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
  curl_setopt_array($ch, array(
      CURLOPT_POST => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_HTTPHEADER => array(
          'Authorization: apikey '.$mck,
          'Content-Type: application/json'
      ),
      CURLOPT_POSTFIELDS => json_encode($data)
  ));
  // Send the request
  $response = curl_exec($ch);
  return "success"; /* success always assumed */
  wp_die();
}

add_action('wp_ajax_register_vote', 'register_vote');
add_action('wp_ajax_nopriv_register_vote', 'register_vote');

function register_vote() {

  $vote    = $_POST["vote"];
  $post_id = $_POST["postId"];

  $votes = get_post_meta( $post_id, "up_down_votes", true );
  if ( "" == $votes) {
    $votes = 0;
  }
  
  $votes += $vote; 
  update_post_meta( $post_id, "up_down_votes", $votes ); 

  echo "success"; /* success always assumed */
  wp_die();
}