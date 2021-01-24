<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>

	<footer class="footer">
		<div class="container">
			<div class="footer-content">
				<?php the_custom_logo(); ?>
				<?php
				if( have_rows('social', 'option') ): ?>
				<ul class="footer-social">
					<?php while( have_rows('social', 'option') ) : the_row(); ?>
					<li><a target="_blank" href="<?php the_sub_field('link'); ?>"><?php the_sub_field('title'); ?></a></li>
			    <?php endwhile; ?>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
