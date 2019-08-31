<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package beluga
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title('<h2 class="entry-title">', '</h2>'); ?>
	</header><!-- .entry-header -->

	<div class="entry-content hyphens">
		<?php the_content(); ?>
		<?php
		wp_link_pages(array(
			'before' => '<div class="page-links">' . __('Pages:', 'beluga'),
			'after' => '</div>',
		));
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link(__('Edit', 'beluga'), '<span class="edit-link">', '</span>'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
