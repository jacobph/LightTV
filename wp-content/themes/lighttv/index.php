<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	<section class="section-highlights" id="section-highlights">
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
							<?php include "play-button.php" ?>
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
							<?php include "play-button.php" ?>
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
							<?php include "play-button.php" ?>
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
							<?php include "play-button.php" ?>
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

	<section class="section-schedule" id="section-schedule">
		<div class="container">
			<h1>schedule</h1>
			<p class="current-days-episodes"><span class="current-day">Today</span>'s Episodes</p>
			<div class="schedule-loading-wrapper js_schedule-loading-wrapper hidden">
				<div class="schedule-controls-wrapper" id="scheduleControlsWrapper">
					<div class="schedule-controls">
						<div class="schedule-controls__month"><span>mar</span></div>
						<div class="schedule-controls__button schedule-controls__prev js_schedule-controls__prev"></div>
						<div class="schedule-controls__week js_schedule-controls__week">
							<!-- built with js -->
						</div> <!-- .schedule-controls__week -->
						<div class="schedule-controls__button schedule-controls__next js_schedule-controls__next"></div>
					</div> <!-- .schedule-controls -->
				</div> <!-- .schedule-controls-wrapper -->
				<div class="schedule js_schedule">
					<div class="schedule__day schedule__day-1 js_schedule__day-1" data-day="1" data-date="">
						<div class="program">
							<div class="program__timeslot">
								<div class="time">8:30am</div>
							</div>
							<div class="program__thumbnail">
								
							</div>
							<div class="program__info">
								<div class="title">Program Title</div>
								<div class="episode">S2.E10 Episode title goes here</div>
								<div class="description">Episode description goes here</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- .schedule-loading-wrapper -->
			<div class="cs-loader js_cs-loader">
			  <div class="cs-loader-inner">
			    <label>	●</label>
			    <label>	●</label>
			    <label>	●</label>
			    <label>	●</label>
			    <label>	●</label>
			    <label>	●</label>
			  </div>
			</div>
		</div>	<!-- .container -->
	</section> <!-- .section-schedule -->

	<section class="section-live" id="section-live"> 
		<div class="container">
			<h1>live</h1>
			<div class="intrinsic-container intrinsic-container-16x9">
				<iframe class="" src="https://player.vimeo.com/video/212986034" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</section> <!-- .section-live -->

	<script src="/wp-content/themes/lighttv/js/temp.js" type="text/javascript"></script>

<?php get_footer(); // This fxn gets the footer.php file and renders it ?>