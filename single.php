<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

<div class="content-blog">
	<div class="container">
		<div class="content-blog--content">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'post' );

			the_post_navigation(
				array(
					'prev_text' => '<div class="nav-links--icon"><i class="bi bi-chevron-left"></i></div><div class="nav-links--link nav-links--preview"><span class="nav-subtitle">' . esc_html__( 'Preview Post:', '_s' ) . '</span> <span class="nav-title">%title</span></div>',
					'next_text' => '<div class="nav-links--link nav-links--next"><span class="nav-subtitle">' . esc_html__( 'Next Post', '_s' ) . '</span> <span class="nav-title">%title</span></div><div class="nav-links--icon"><i class="bi bi-chevron-right"></i></div>',
				)
			);

		endwhile; // End of the loop.
		?>

			</div>
		</div>
	</div>

<?php
get_footer();
