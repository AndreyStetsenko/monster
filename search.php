<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _s
 */

get_header();
?>

<div class="content-blog">
	<div class="container">
		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
		<ul class="codyshop-ajax-search"></ul>
		<div class="content-blog--content">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
		?>
		</div>
		<div class="pagination">
			<?php
			echo paginate_links(
				array(
					'prev_text' => '<i class="bi bi-chevron-left"></i>',
					'next_text' => '<i class="bi bi-chevron-right"></i>',
				)
			);
			?>
		</div>
	</div>
</div>

<?php
get_footer();
