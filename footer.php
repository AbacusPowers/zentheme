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
		<div id="site-info">
<!--			<a href="--><?php //echo esc_url( __( 'https://wordpress.org/', 'zentheme' ) ); ?><!--">--><?php //printf( esc_html__( 'Proudly powered by %s', 'zentheme' ), 'WordPress' ); ?><!--</a>-->
			<span class="copyright">&copy; 2015 360 Zen</span>
			<span class="sep"> | </span>
			<a href="https://bitbucket.org/360zen/zentheme">Zentheme</a> by <a href="<?php echo esc_url( __('http://360zen.com/','zentheme') ); ?>" rel="designer">Justin Maurer</a>
		</div><!-- .site-info -->
		<div id="footer-social">
			Find me online:
			<span class="social-link"><a href="https://github.com/AbacusPowers" title="GitHub"><i class="fa fa-github"></i></a></span>
			<span class="social-link"><a href="https://plus.google.com/+360zen" title="Google+"><i class="fa fa-google-plus"></i></a></span>
			<span class="social-link"><a href="https://www.facebook.com/360zen/" title="Google+"><i class="fa fa-facebook"></i></a></span>
		</div>
		<div id="footer-search"><?php get_search_form(); ?></div>
		<button class="fab to-top" alt="Scroll to the top, please" title="Scroll to the top, please"><i class="material-icons">arrow_upward</i></button>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php include_once("analyticstracking.php") ?>
</body>
</html>
