<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package YSN
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info entry-footer">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ysn' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'ysn' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'ysn' ), 'ysn', '<a href="http://www.ysn.com" rel="designer">Michael Washburn</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
