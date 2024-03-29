<?php
/**
 * The template for displaying search results pages.
 *
 * @package beluga
 */

get_header(); ?>

<section id="primary" class="content-area">
	<div class="inner">
		<main id="main" class="site-main" role="main">

			<?php if (have_posts()) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf(__('Search Results for: %s', 'beluga'), '<span>' . get_search_query() . '</span>'); ?></h1>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while (have_posts()) : the_post(); ?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
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
