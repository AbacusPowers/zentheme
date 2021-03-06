<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zen_Theme_Alpha
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php zentheme_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php $image_info = getimagesize($post->guid); ?>
		<img src="<?php echo $post->guid; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" <?php echo $image_info[3]; ?> />

		<?php
//			wp_link_pages( array(
//				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zentheme' ),
//				'after'  => '</div>',
//			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php zentheme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

