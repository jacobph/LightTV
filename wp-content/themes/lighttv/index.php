<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	<section class="section-highlights">
		<div class="container">
			<h1>this month</h1>
		</div>
		<?php
			// $args = array (
			//   'pagination' => true,
			//   'posts_per_page' => 4,
			//   'cat' => 3,
			//   'ignore_stickie_posts' => true,
			// );

			// query_posts( $args );
			?>
		<?php 
		$topPosts = get_posts(array(
	    'pagination' => true,
		  'posts_per_page' => 4,
		  'cat' => 3,
		  'ignore_stickie_posts' => true,
    ));
    ?>
		<div class="highlights">
			<div class="highlights__left">
				<div class="highlights__block highlight-block-1">
					<?php 
			    	$title = $topPosts[0]->post_title;
			    	$content = $topPosts[0]->post_content;
			    	$videoURL = $topPosts[0]->vimeo_url;
			    	$thumbURL = get_the_post_thumbnail_url( $topPosts[0]->ID, 'large' );
					?>
					<a href="<?php echo $videoURL; ?>" class="mediabox" title="<?php echo $title ?>">
						<div class="highlights__block__image" style="background-image:url(<?php echo $thumbURL; ?>)"></div>
						<div class="highlights__block__info">
							<img src="/wp-content/themes/lighttv/img/White_PlayButton.svg" alt="" class="highlights__block__info__icon">
							<div class="highlights__block__info__summary">
								<div class="highlights__block__info__summary__title"><?php echo $title; ?></div>
								<div class="highlights__block__info__summary__summary"><?php echo $content; ?></div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="highlights__right">
				<div class="highlights__block highlight-block-2">
					<?php 
			    	$title = $topPosts[1]->post_title;
			    	$content = $topPosts[1]->post_content;
			    	$videoURL = $topPosts[1]->vimeo_url;
			    	$thumbURL = get_the_post_thumbnail_url( $topPosts[1]->ID, 'large' );
					?>
					<a href="<?php echo $videoURL; ?>" class="mediabox" title="<?php echo $title ?>">
						<div class="highlights__block__image" style="background-image:url(<?php echo $thumbURL; ?>)"></div>
						<div class="highlights__block__info">
							<img src="/wp-content/themes/lighttv/img/White_PlayButton.svg" alt="" class="highlights__block__info__icon">
							<div class="highlights__block__info__summary">
								<div class="highlights__block__info__summary__title"><?php echo $title; ?></div>
								<div class="highlights__block__info__summary__summary"><?php echo $content; ?></div>
							</div>
						</div>
					</a>
				</div>
				<div class="highlights__block highlight-block-3">
					<?php 
			    	$title = $topPosts[2]->post_title;
			    	$content = $topPosts[2]->post_content;
			    	$videoURL = $topPosts[2]->vimeo_url;
			    	$thumbURL = get_the_post_thumbnail_url( $topPosts[2]->ID, 'large' );
					?>
					<a href="<?php echo $videoURL; ?>" class="mediabox" title="<?php echo $title ?>">
						<div class="highlights__block__image" style="background-image:url(<?php echo $thumbURL; ?>)"></div>
						<div class="highlights__block__info">
							<img src="/wp-content/themes/lighttv/img/White_PlayButton.svg" alt="" class="highlights__block__info__icon">
							<div class="highlights__block__info__summary">
								<div class="highlights__block__info__summary__title"><?php echo $title; ?></div>
								<div class="highlights__block__info__summary__summary"><?php echo $content; ?></div>
							</div>
						</div>
					</a>
				</div>
				<div class="highlights__block highlight-block-4">
					<?php 
			    	$title = $topPosts[3]->post_title;
			    	$content = $topPosts[3]->post_content;
			    	$videoURL = $topPosts[3]->vimeo_url;
			    	$thumbURL = get_the_post_thumbnail_url( $topPosts[3]->ID, 'large' );
					?>
					<a href="<?php echo $videoURL; ?>" class="mediabox" title="<?php echo $title ?>">
						<div class="highlights__block__image" style="background-image:url(<?php echo $thumbURL; ?>)"></div>
						<div class="highlights__block__info">
							<img src="/wp-content/themes/lighttv/img/White_PlayButton.svg" alt="" class="highlights__block__info__icon">
							<div class="highlights__block__info__summary">
								<div class="highlights__block__info__summary__title"><?php echo $title; ?></div>
								<div class="highlights__block__info__summary__summary"><?php echo $content; ?></div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section><!-- .section-highlights -->

	<section class="section-schedule">
		<div class="container">
			<h1>schedule</h1>
		</div>
	</section> <!-- .section-schedule -->

	<section class="section-live">
		<div class="container">
			<h1>live</h1>
			<div class="intrinsic-container intrinsic-container-16x9">
				<iframe class="" src="https://player.vimeo.com/video/212986034" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</section> <!-- .section-live -->

	<div id="primary" style="display: none">
		<div id="content" role="main" class="span8 offset2">
			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			// In the case of the home page, this will call for the most recent posts 
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have some posts to show, start a loop that will display each one the same way
				?>

					<article class="post">
						<h1 class="title">
							<a href="<?php the_permalink(); // Get the link to this post ?>" title="<?php the_title(); ?>">
								<?php the_title(); // Show the title of the posts as a link ?>
							</a>
						</h1>
						<div class="post-meta">
							<?php the_time('m/d/Y'); // Display the time published ?> | 
							<?php if( comments_open() ) : // If we have comments open on this post, display a link and count of them ?>
								<span class="comments-link">
									<?php comments_popup_link( __( 'Comment', 'break' ), __( '1 Comment', 'break' ), __( '% Comments', 'break' ) ); 
									// Display the comment count with the applicable pluralization
									?>
								</span>
							<?php endif; ?>
						
						</div><!--/post-meta -->
						
						<div class="the-content">
							<?php the_content( 'Continue...' ); 
							// This call the main content of the post, the stuff in the main text box while composing.
							// This will wrap everything in p tags and show a link as 'Continue...' where/if the
							// author inserted a <!-- more --> link in the post body
							?>
							
							<?php wp_link_pages(); // This will display pagination links, if applicable to the post ?>
						</div><!-- the-content -->
		
						<div class="meta clearfix">
							<div class="category"><?php echo get_the_category_list(); // Display the categories this post belongs to, as links ?></div>
							<div class="tags"><?php echo get_the_tag_list( '| &nbsp;', '&nbsp;' ); // Display the tags this post has, as links separated by spaces and pipes ?></div>
						</div><!-- Meta -->
						
					</article>

				<?php endwhile; // OK, let's stop the posts loop once we've exhausted our query/number of posts ?>
				
				<!-- pagintation -->
				<div id="pagination" class="clearfix">
					<div class="past-page"><?php previous_posts_link( 'newer' ); // Display a link to  newer posts, if there are any, with the text 'newer' ?></div>
					<div class="next-page"><?php next_posts_link( 'older' ); // Display a link to  older posts, if there are any, with the text 'older' ?></div>
				</div><!-- pagination -->


			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">Nothing has been posted like that yet</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having posts or not having any posts) ?>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>