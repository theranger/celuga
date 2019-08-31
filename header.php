<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package beluga
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'beluga'); ?></a>

	<header id="masthead" class="site-header" <?php echo beluga_header_image_background(); ?> role="banner">
		<div class="masthead-opacity"></div>
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
									  rel="home"><?php bloginfo('name'); ?></a></h1>
			<h2 class="site-description"><?php bloginfo('description'); ?></h2>
		</div>
	</header><!-- #masthead -->
	<div id="site-menu" class="site-menu clear">
		<div id="menu-inner">
			<nav class="main-navigation menu-column" role="navigation">
				<?php wp_nav_menu(array('theme_location' => 'primary',
					'depth' => 2,)); ?>
				<?php get_search_form(); ?>
			</nav><!-- #site-navigation -->
			<div class="sidebar sidebar-1  menu-column justified">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</div>
			<div class="sidebar sidebar-2  menu-column justified">
				<?php dynamic_sidebar('sidebar-2'); ?>
			</div>
			<div class="sidebar sidebar-2  menu-column justified">
				<?php dynamic_sidebar('sidebar-3'); ?>
			</div>
		</div>
		<nav id="menu-button" class="clear">
			<a href="#"><span class="genericon genericon-menu"></span></a>
		</nav>
	</div>
	<div id="content" class="site-content">
