<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>
<section class="section-finder">
	<div class="container">
		<div class="flex">
			<h1><span>FIND</span> <img src="/wp-content/themes/lighttv/img/LOGOS/LTV_LOGO_WHITE.png" alt="LIGHTtv"> <span>IN YOUR AREA</span></h1>
			<form action="" class="zip-lookup">
				<label for="zip" class="screen-reader-text">ZIP Code</label>
				<input type="text" name="zip" placeholder="ZIP Code" class="zip-lookup__input">
				<div class="zip-lookup__submit">
					<img src="/wp-content/themes/lighttv/img/White_CarrotArrow.svg" alt="Search">
				</div>
			</form>
			<div class="lookup-result">
				<div>Watch LIGHTtv on:</div>
				<div>Broadcast Channel 42.0</div>
			</div>
		</div>
	</div>
</section>
</main><!-- / end page container, begun in the header -->

<footer class="site-footer">
	<div class="container footer-container">
		<ul class="footer-links">
			<li><a href="#">Terms &amp; Conditions</a></li>
			<li><a href="#">Privacy</a></li>
			<li><a href="">Advertising</a></li>
			<li><a href="">Affiliate</a></li>
			<li><a href="">Contact</a></li>
		</ul>
		<p class="copyright">Copyright © 2017 MGM All rights reserved</p>
		<?php include "social-icons.php" ?>
	</div>
</footer><!-- .site-footer -->

<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>

</body>
</html>
