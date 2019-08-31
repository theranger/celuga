<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package beluga
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php _e('Location Cannot be Found', 'beluga'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<div class="search-404">
					<span><?php _e('Nothing was found at this location. Try one of these other options.', 'beluga'); ?></span>
					<?php get_search_form(); ?><br>
				</div>
				<div class="content-404">
					<div class="menu-column justified">
						<?php the_widget('WP_Widget_Recent_Posts'); ?>
					</div>
					<div class="menu-column justified">
						<?php if (beluga_categorized_blog()) : // Only show the widget if site has multiple categories. ?>
							<div class="widget widget_categories">
								<h2 class="widget-title"><?php _e('Most Used Categories', 'beluga'); ?></h2>
								<ul>
									<?php
									wp_list_categories(array(
										'orderby' => 'count',
										'order' => 'DESC',
										'show_count' => 1,
										'title_li' => '',
										'number' => 10,
									));
									?>
								</ul>
							</div><!-- .widget -->
						<?php endif; ?>
					</div>
					<div class="menu-column justified">
						<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'beluga'), convert_smilies(':)')) . '</p>';
						the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
						?>
					</div>
					<div class="menu-column justified">
						<?php the_widget('WP_Widget_Tag_Cloud'); ?>
					</div>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
