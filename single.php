<?php
get_header();
?>
<div class="center" style='margin-top:40px;'>
	<?php get_template_part( 'parts/adsense-header' ); ?>
</div>
<div class="container mb-40">
<?php
while ( have_posts() ) :
	the_post();
	$cats = get_the_category();
	if ( false !== get_the_post_thumbnail_url() ) {
		$image = get_the_post_thumbnail_url( null, 'post-featured-image' );
	} elseif ( function_exists( 'z_taxonomy_image_url' ) ) {
			$image = z_taxonomy_image_url( $cats[0]->cat_ID );
	}
	?>
	<div id="single-page" class="bg-white container-padding" style='margin: 0px auto;'>

		<h1 class="mb-40 heading-link">
		<?php the_title(); ?>
		</h1>

		<div class="row">  
		<div class="col-md-12">
			<div class="card-image">
			<img style='height:300px;min-width:100%;object-fit:cover;' src='<?php echo esc_url( $image ); ?>' />
			</div>
		</div>
		</div>

		<div class="row">  
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="pt-4" style='color:gray;font-size:10pt;'>

			<div style='float:right'>
				<div class="addthis_inline_share_toolbox"></div>
			</div> 

			<?php
			$authorId        = get_the_author_meta( 'ID' );
			$authorFirstName = get_the_author_meta( 'first_name' );
			$authorLastName  = get_the_author_meta( 'last_name' );
			$avatar          = get_avatar(
				$authorId,
				$size        = 100,
				$default     = '',
				$alt         = 'Post author: ' . $authorFirstName . ' ' . $authorLastName,
				$args        = array(
					'class' => 'avatar-post-list',
				)
			);
			?>
			<div>
				<div class="responsive-margin-top-20" style='float:left;padding-right:40px;'>
				<div style="text-align:center;">
					<a href="Javascript: registerVote(1, <?php echo get_the_ID(); ?>);" alt="Up vote the post" title="Up vote the post">
					<img id="up-vote-arrow" src="<?php bloginfo( 'template_directory' ); ?>/images/up.png" alt="Up vote the post" style="width:30px;" />
					</a>
				</div>
				<div id="total-votes" style="color: gray;font-size:24pt;text-align:center;line-height:1.3;">
				<?php
				$votes = get_field( 'up_down_votes' );
				if ( '' != $votes ) {
					echo $votes;
				} else {
					echo '0';
				}
				?>
				</div>
				<div style="text-align:center;">
					<a href="Javascript: registerVote(-1, <?php echo get_the_ID(); ?>);" alt="Down vote the post" title="Down vote the post">
					<img id="down-vote-arrow" src="<?php bloginfo( 'template_directory' ); ?>/images/down.png" alt="Down vote the post" style="width:30px;" />
					</a>
				</div>
				</div>
				<div class="responsive-margin-top-20" style='float:left;'>
				<?php echo $avatar; ?> 
				</div>
				<div class="responsive-margin-top-20" style='float:left;padding-left:20px;'>
					<span style='font-weight:bold;font-size:14pt;color:#000;'><?php echo $authorFirstName . ' ' . $authorLastName; ?></span><br/>
					<?php the_time( 'n/j/y' ); ?> in <br/>
					<?php echo get_the_category_list( ', ' ); ?> <br/>
					<?php
					$posttags = get_the_tags();
					if ( $posttags ) {
						foreach ( $posttags as $tag ) {
							echo "<a href='" . get_tag_link( $tag ) . "' style='color:#fff;text-decoration:none;display:inline-block;margin-top:15px;margin-bottom:25px;'><span class='me-1 mt-2' style='background-color:#FF7F50;padding:12px 15px;'>" . $tag->name . '</span></a>';
						}
					}
					?>
				</div>
				<!--
				<div style='float:right'>
				<div class="addthis_inline_share_toolbox"></div>
				</div>
				--> 
			</div>
			</div> 
		</div>
		<div class="col-md-1"></div>
		</div>

		<div class="generic-content" style='padding-top:10px;'>
		<p style='color:#555'><?php the_content(); ?></p>
		</div>

	</div>

	<script>
		jQuery(function($){
		let previousVote = localStorage.getItem("up_down_votes_<?php echo get_the_ID(); ?>");
		if (previousVote == 1) {
			$("#up-vote-arrow").attr("src", "<?php bloginfo( 'template_directory' ); ?>/images/up-orange.png?time=<?php echo date( 'ymdhms' ); ?>");
		} else if (previousVote == -1) {
			$("#down-vote-arrow").attr("src", "<?php bloginfo( 'template_directory' ); ?>/images/down-orange.png?time=<?php echo date( 'ymdhms' ); ?>");
		}
		});
	</script>

	<div id="newsletter_success_strip" style='display:none;clear:both;background-color:#FEF9E7;text-align:center;padding:50px;'>
		<h2 style='margin-bottom:40px;color:#424a4f;'>
			Thank you for being awesome and signing up!
		</h2>
	</div>

	<div id="newsletter_form_strip" style='clear:both;background-color:#FEF9E7;text-align:center;padding:50px;'>
		<h2 style='margin-bottom:40px;color:#424a4f;'>Sign up today for our weekly newsletter about AI, SEO, and Entrepreneurship</h2>
		<form class="form-inline" action="javascript:joinNewsletter();" >
			<div>
			<input class="form-control newsletter-email" type='email' id="email_for_newsletter" required placeholder="Enter your email" style="height:60px;font-size:18pt;" /> 
			</div>
			<div style='margin-top:20px;'>
			<input type="submit" value="Sign Up" class="btn btn-free-trial" style='border-radius:0px;background-color:#F4D03F;color:#424a4f;padding-left:30px;padding-right:30px;padding-top:10px;padding-bottom:10px;font-size:18pt;' />
			</div>
		</form>
	</div>

	<div>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
	</div>

	<h2 style='width:90%;margin:50px auto 0px auto;text-align:center;font-size:32pt !important;margin-bottom:40px;'>
		Read Next
	</h2>
	<div>
		<div class="row">
		<?php
		$categories = get_the_category();
		if ( count( $categories ) > 0 ) :
			?>
			<?php
				$args          = array(
					'post_status'    => 'publish',
					'category__in'   => $categories[0]->cat_ID,
					'post__not_in'   => array( get_the_ID() ),
					'orderby'        => 'date',
					'order'          => 'DESC',
					'posts_per_page' => 6,
				);
				$related_posts = new WP_Query( $args );
				while ( $related_posts->have_posts() ) :
					$related_posts->the_post();
					$related_image = get_the_post_thumbnail_url( null, 'category-image' );
					?>
				<div class="col-md-4 card" style='margin-bottom:40px;border:0px;'>
					<div class="row" style='min-height:350px;border:1px solid #efefef;margin-left:20px;margin-right:20px;'>
					<div class="row card-image" style="padding:0px;margin:0px;background-color:#efefef;">
						<?php if ( $related_image !== false ) { ?>
						<img style='margin:0px;padding:0px;height:180px;min-width:100%;object-fit:cover;' src='<?php echo esc_url( $related_image ); ?>' />
						<?php } else { ?>
						<div style='margin:0px;padding:0px;height:180px;min-width:100%;'>&nbsp;</div>
						<?php } ?>
						<?php
						get_template_part( 'parts/vote-badge' );
						?>
					</div>
					<div class="row card-content" style='padding:40px;'>
						<h2 class='color-black'>
						<a href='<?php echo get_permalink(); ?>' style='text-decoration: none !important; color: #000 !important;'>
							<?php echo wp_kses_post( get_the_title() ); ?>
						</a>
						</h2>
					</div>
					</div>
				</div>
					<?php
				endwhile;
				?>
		</div>
		<?php endif; ?>  
	<div>
	<?php
	endwhile;
?>
</div>
<?php get_footer(); ?>
