<?php
/**
 * @package beluga
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php $category_list = get_the_category_list(__(', ', 'wideformatscanning'));
		$top_cat_array = explode(",", $category_list);
		if (count($top_cat_array) > 3) {
			$top_cat_array[3] = ' etc.';
		} else {
			$top_cat_array[3] = null;
		}
		for ($i = 0; $i <= 3; $i++) {
			if (isset($top_cat_array[$i])) {
				$top_cat_final[$i] = $top_cat_array[$i];
			}
		}
		$top_cat_list = implode(", ", $top_cat_final);

		echo '<h3 class="category-list">' . $top_cat_list . '</h3>'; ?>
		<?php the_title('<h2 class="entry-title">', '</h2>'); ?>

		<?php if ('post' == get_post_type()) : ?>
			<div class="entry-meta">
				<?php beluga_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content hyphens">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'beluga')); ?>
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
