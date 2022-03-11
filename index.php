<?php get_header(); ?>

<div class="container px-5 py-24 mx-auto">
	<div class="flex flex-wrap -m-4">

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php endwhile; ?>
		<?php endif; ?>
		
	</div>
</div>

<?php
get_footer();
