
<?php get_header(); ?>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
				<h1><?php the_title(); ?></h1>
				<h4>Posted on <?php the_time('F jS, Y') ?></h4>
				<?php the_content(__('(more...)')); ?>
		
			
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>



<?php get_footer(); ?>
