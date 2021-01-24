<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">
		<nav class="navbar navbar-expand-md">
		  <div class="container">
				<?php
				the_custom_logo(); ?>

		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <div class="navbar-toggler-border"></div>
					<div class="navbar-toggler-border"></div>
					<div class="navbar-toggler-border"></div>
		    </button>

		    <div class="collapse navbar-collapse" id="navbarSupportedContent">

					<div class="container-main">
						<?php
						wp_nav_menu( array(
					    'theme_location'  => 'primary',
					    'depth'           => 3, // 1 = no dropdowns, 2 = with dropdowns.
					    'container'       => 'div',
					    'container_class' => '',
					    'container_id'    => '',
					    'menu_class'      => 'navbar-nav mr-auto',
						) );
						?>
					</div>
		    </div>
				<form role="search" method="get" class="d-flex search-form" action="/">
					<input type="search" class="form-control me-2 search-field" value="" name="s">
					<button type="submit" name="button" class="btn search-submit"><i class="bi bi-search"></i></button>
				</form>

				<div class="container-border"></div>
		  </div>
		</nav>
	</header>
