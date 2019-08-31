<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package beluga
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="inner">
		<div class="site-info">
			<a href="<?php echo esc_url(__('http://wordpress.org/', 'beluga')); ?>"><?php printf(__('Proudly powered by %s', 'beluga'), 'WordPress'); ?></a>
			<span class="sep"> | </span>
			<?php printf(__('Theme: %1$s by %2$s.', 'beluga'), 'Beluga', '<a href="http://basilosaur.us" target="_blank">basilosaur.us</a>'); ?>
			<br><?php beluga_license_info('echo') ?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<!--<a id="tothetop" href="#"><span class="genericon genericon-collapse"></span></a>-->
<div id="tothetop" class="icon-circle"><a href="#"><span class="genericon genericon-collapse"></span></a></div>
<?php wp_footer(); ?>

</body>
</html>
