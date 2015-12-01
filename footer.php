<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zen_Theme_Alpha
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
<!--			<a href="--><?php //echo esc_url( __( 'https://wordpress.org/', 'zentheme' ) ); ?><!--">--><?php //printf( esc_html__( 'Proudly powered by %s', 'zentheme' ), 'WordPress' ); ?><!--</a>-->
			<span class="copyright">&copy; 2015 Justin Maurer</span>
			<span class="sep"> | </span>
			Zentheme by <a href="<?php echo esc_url( __('http://360zen.com/','zentheme') ); ?>" rel="designer">Justin Maurer</a>
		</div><!-- .site-info -->
		<button class="fab to-top" alt="Scroll to the top, please" title="Scroll to the top, please"><i class="material-icons">arrow_upward</i></button>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
