<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zen_Theme_Alpha
 */
$languages = get_post_meta(get_the_ID(), '_zenerator_languages');
$images = get_children();
$features = get_post_meta(get_the_ID(), '_zenerator_features')
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<span class="meta-label--languages">Langauges &amp; Frameworks:</span>
			<?php get_project_languages(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			// check if the post has a Post Thumbnail assigned to it.
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
		?>
		<?php
			the_content();

			echo '<h2>Features</h2><ul>';
			foreach($features[0] as $feature) {
				echo '<li>' . $feature . '</li>';
			}
			echo '</ul>';
			$gallery_shortcode = '[gallery id="' . get_the_ID() . '"]';

			print apply_filters( 'the_content', $gallery_shortcode );
		?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zentheme' ),
			'after'  => '</div>',
		) );
		?>
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php zentheme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

