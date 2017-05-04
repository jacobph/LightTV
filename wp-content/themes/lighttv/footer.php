<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>
<?php include 'finder.php'; ?>
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
