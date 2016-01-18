<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zen_Theme_Alpha
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main article-grid" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/card', 'project' );
				?>

			<?php endwhile; ?>

			<?php the_posts_pagination( array(
					'mid_size' 			 => 0,
					'prev_text'          => __( 'Previous page', 'zentheme' ),
					'next_text'          => __( 'More posts', 'zentheme' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'zentheme' ) . ' </span>',
			) ); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
