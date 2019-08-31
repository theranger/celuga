<?php
/**
 * @package beluga
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<?php if ('post' == get_post_type()) : ?>
			<div class="entry-meta">
				<?php beluga_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-thumbnail">
		<?php
		$options = get_option('beluga_theme_settings');
		if (isset($options['featured_frontpage'])) {
			$featured_frontpage = $options['featured_frontpage'];
		} else {
			$featured_frontpage = 1;
		}
		if ((!get_post_format() == 'aside') && (!get_post_format() == 'quote') && (!get_post_format() == 'video')
			&& (!get_post_format() == 'audio') && (!get_post_format() == 'image') && (!get_post_format() == 'status')
			&& (has_post_thumbnail()) && ($featured_frontpage == 1)) {
			echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">';
			the_post_thumbnail('post-thumbnail', array('class' => "aligncenter"));
			echo '</a>';
		}
		?>
	</div>
	<div class="entry-content justified">
		<?php
		if ((get_post_format() == 'aside') || (get_post_format() == 'quote') || (get_post_format() == 'video')
			|| (get_post_format() == 'audio') || (get_post_format() == 'image') || (get_post_format() == 'status')) {
			the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'beluga'));
		} else {
			the_excerpt(__('Continue reading <span class="meta-nav">&rarr;</span>', 'beluga'));
		}
		?>
		<?php
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'beluga'),
			'after' => '</div>',
		));
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(__(', ', 'beluga'));
			if ($categories_list && beluga_categorized_blog()) :
				?>
				<span class="cat-links">
				<?php printf(__('<span class="genericon genericon-category"></span> %1$s', 'beluga'), $categories_list); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', __(', ', 'beluga'));
			if ($tags_list) :
				?>
				&nbsp;|&nbsp;<span class="tags-links">
				<?php printf(__('<span class="genericon genericon-tag"></span> %1$s', 'beluga'), $tags_list); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if (!post_password_required() && (comments_open() || '0' != get_comments_number())) : ?>
			&nbsp;|&nbsp;&nbsp;<span
					class="comments-link"><?php comments_popup_link(__('Leave a comment', 'beluga'), __('1 Comment', 'beluga'), __('% Comments', 'beluga')); ?></span>
		<?php endif; ?>

		<?php edit_post_link(__('Edit', 'beluga'), '<span class="edit-link">', '</span>'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
