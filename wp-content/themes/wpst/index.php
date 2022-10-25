<?php get_header(); ?>

<?php View::render('sections/navbar') ?>
<?php View::render('sections/slider') ?>

<section class="section-main">
    <div class="container">
        <div class="row">
	        <?php View::render('sections/content') ?>
	        <?php View::render('sections/aside') ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

