<?php wp_footer(); ?>

<footer id="contact" name="contact" class="contact">
<div id="footer-content">
	<div id="sayhello" class="box">
		<h2>Say hello</h2>
		<p>Seraina Cavigelli<br />
		seraina.cavigelli@gmail.com<br />
		+41 78 741 83 96</p>
	</div>
	
	<div id="followme" class="box">
		<h2>Follow me</h2>
		
	</div>
	
	<div id="miniMenu" class="box">
		<h2>Irgendwas</h2>
		
	</div>
	<div class="clear"></div>
</div>
</footer>

</div><!-- main-container -->

<script src="<?php bloginfo('template_url'); ?>/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/masonry.pkgd.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/classie.js"></script>
<!--<script src="<?php bloginfo('template_url'); ?>/js/cbpGridGallery.js"></script>-->
<!--cripple browser support -->
<script type="text/javascript">
// if crappy problembrowser aka Firefox
if ( $.browser.mozilla == true ) {
    $.getScript( template_url + "/js/cbpGridGallery-ff.js", function() {
        new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
    });
// If good browser
} else {
    $.getScript( template_url + "/js/cbpGridGallery.js", function() {
        new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
    });
}
</script>
</body>
</html>