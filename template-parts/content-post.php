<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<div id="post-<?php the_ID(); ?>" class="post post-single">
	<div class="post-head">
		<div class="post-head--icon"></div>
	</div>
	<?php if (has_post_thumbnail()) : ?>
		<div class="post-img">
			<?php the_post_thumbnail(); ?>
			<div class="post-img--overlay"></div>
		</div>
	<?php endif; ?>
	<div class="post-body">
		<div class="post-body--meta">
			<span>
				<?php _s_posted_on(); ?>, by
				<?php bloginfo('name'); ?>
			</span>
		</div>
		<?php the_title('<h2 class="post-body--title">', '</h2>'); ?>
		<div class="post-body--content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			?>
		</div>
	</div>
</div>
