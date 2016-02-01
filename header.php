<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zen_Theme_Alpha
 */
$logo_url = get_header_image();
$description = get_bloginfo( 'description', 'display' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--METAQUERY-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="breakpoint" content="small" media="(max-width: 768px)">
<meta name="breakpoint" content="medium" media="(min-width: 769px) and (max-width: 1024px)">
<meta name="breakpoint" content="large" media="(min-width: 1025px) and (max-width: 1399px)">
<meta name="breakpoint" content="wide" media="(min-width: 1400px)">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php comments_popup_script(400, 500); ?>
<script src="https://use.typekit.net/kpc3dau.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zentheme' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

<!--			<h1 class="site-title">-->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php
						if ( $description || is_customize_preview() ) :
							echo $description; /* WPCS: xss ok. */
						endif; ?>">
					<?php if ( $logo_url && !empty($logo_url) ) { ?>
						<img src="<?php echo $logo_url; ?>" id="masthead-logo" alt="<?php bloginfo( 'name') ?>" />
					<?php } else {
						bloginfo( 'name' );
					} ?>
				</a>
<!--			</h1>-->

		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'container_class' => 'menu'
					)
				); ?>
		</nav><!-- #site-navigation -->
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="material-icons">dehaze</i></button>
<!--		--><?php
//		$description = get_bloginfo( 'description', 'display' );
//		if ( $description || is_customize_preview() ) : ?>
<!--			<p class="site-description">--><?php //echo $description; /* WPCS: xss ok. */ ?><!--</p>-->
<!--		--><?php //endif; ?>
	</header><!-- #masthead -->

	<div id="overlay"></div>
	<div id="modal">
		<a href="#" id="close-modal"><i class="material-icons">clear</i></a>
		<div id="modal-content">
		</div>
	</div>
	<div id="content" class="site-content">
