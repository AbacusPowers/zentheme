<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zen_Theme_Alpha
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<div class="card-container">
		<a href="javascript:void(0)" class="destroy-card" title="I'm done reading this. Get it outta here!" alt="remove card from page"><i class="material-icons">delete</i></a>
		<div class="post-thumbnail-container">
			<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail('card-min');
			}
			?>
		</div>

		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" class="article-link" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php zentheme_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'zentheme' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
//			zentheme_excerpt_more('Read More');
			the_excerpt();
			?>

			<?php
			wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zentheme' ),
					'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php zentheme_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
