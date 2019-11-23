<body>
	<?php get_header(); ?>
	<div id="ttr_main" class="row">
		<div id="ttr_content" class="col-lg-8 col-sm-8 col-md-8 col-xs-12">

			<div class="row">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<h1><?php the_title(); ?></h1>
					<h4>Posted on <?php the_time('F jS, Y') ?></h4>
					<p><?php the_content(__('(more...)')); ?></p>
				</div>
				
				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

			</div>
		</div>
	</div>

	<?php get_footer(); ?>
</body>