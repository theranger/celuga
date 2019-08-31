<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package beluga
 */

get_header(); ?>

<section id="primary" class="content-area">
	<div class="inner">
		<main id="main" class="site-main" role="main">

			<?php if (have_posts()) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						if (is_category()) :
							single_cat_title();

						elseif (is_tag()) :
							single_tag_title();

						elseif (is_author()) :
							printf(__('Posts by %s', 'beluga'), '<span class="vcard">' . get_the_author() . '</span>');

						elseif (is_day()) :
							printf(__('Posts for %s', 'beluga'), '<span>' . get_the_date() . '</span>');

						elseif (is_month()) :
							printf(__('Posts for %s', 'beluga'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'beluga')) . '</span>');

						elseif (is_year()) :
							printf(__('Posts for %s', 'beluga'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'beluga')) . '</span>');

						elseif (is_tax('post_format', 'post-format-aside')) :
							_e('Asides', 'beluga');

						elseif (is_tax('post_format', 'post-format-gallery')) :
							_e('Galleries', 'beluga');

						elseif (is_tax('post_format', 'post-format-image')) :
							_e('Images', 'beluga');

						elseif (is_tax('post_format', 'post-format-video')) :
							_e('Videos', 'beluga');

						elseif (is_tax('post_format', 'post-format-quote')) :
							_e('Quotes', 'beluga');

						elseif (is_tax('post_format', 'post-format-link')) :
							_e('Links', 'beluga');

						elseif (is_tax('post_format', 'post-format-status')) :
							_e('Statuses', 'beluga');

						elseif (is_tax('post_format', 'post-format-audio')) :
							_e('Audios', 'beluga');

						elseif (is_tax('post_format', 'post-format-chat')) :
							_e('Chats', 'beluga');

						else :
							_e('Archives', 'beluga');

						endif;
						?>
					</h1>
					<?php if ((is_author()) && (get_the_author_meta('description'))) {
						echo '<p class="archive-meta justified">' . get_the_author_meta('description') . '</p>';
					} elseif (term_description()) {
						printf('<div class="archive-meta justified">%s</div>', term_description());
					} ?>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while (have_posts()) : the_post(); ?>

					<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part('content', get_post_format());
					?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part('content', 'none'); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div>
</section><!-- #primary -->

<?php beluga_paging_nav(); ?>

<?php get_footer(); ?>
