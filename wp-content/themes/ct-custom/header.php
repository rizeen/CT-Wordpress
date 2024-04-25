<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ct-custom' ); ?></button>
		</nav><!-- #site-navigation -->

		<div class="top_banner">
			<div class="top_banner_left">
				<div class="txtred">
				CALL US NOW!
				</div>
				<a href="tel:385-154-11-28-35" class="txtwhite">
				385.154.11.28.35
				</a>
			</div>
			<div class="top_banner_right">
				<div class="txtred">
				LOGIN
				</div>
				<div class="txtwhite">
				SIGNUP
				</div>
			</div>
    	</div>
		<div class="mymenu">
			<div class="mymenu_left">
				<?php
					$logo_image_id = get_option('logo_image');
					$logo_image_url = wp_get_attachment_image_src($logo_image_id, 'full');
					?>
				<img src="<?php echo esc_url($logo_image_url[0]); ?>" alt="Logo" />
			</div>
			<div class="mymenu_right">
				<?php
					// Display the right menu
					wp_nav_menu(array(
						'theme_location' => 'top-right',
						'container' => false,
						'menu_class' => 'top-right-menu-class',
						'menu_id' => 'nav',
						'fallback_cb' => '__return_false',
					));		
				?>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
