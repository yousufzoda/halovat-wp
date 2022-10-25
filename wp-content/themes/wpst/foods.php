<?php get_header(); ?>

<?php View::render('sections/navbar') ?>

	<section class="section-main">
		<div class="container">
			<div class="row">
				<?php View::render('sections/foods') ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>