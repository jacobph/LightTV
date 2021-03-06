<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>
</main><!-- / end page container, begun in the header -->

<footer>
	<?php include 'finder.php'; ?>
	<div class="site-footer">
		<div class="container footer-container">
			<!-- <ul class="footer-links">
				<li><a href="#">Terms&nbsp;&amp;&nbsp;Conditions</a></li>
				<li><a href="#">Privacy</a></li>
				<li><a href="">Advertising</a></li>
				<li><a href="">Affiliate</a></li>
				<li><a href="">Contact</a></li>
			</ul> -->
			<div class="footer-links">
				<?php wp_nav_menu( array( 'menu' => 'Footer Menu' ) ); // Display the user-defined menu in Appearance > Menus ?>
			</div>
			<p class="copyright">Copyright © 2017 MGM All rights reserved</p>
			<?php include "social-icons.php" ?>
		</div>
	</div>
</footer><!-- .site-footer -->

<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>

</body>
</html>
