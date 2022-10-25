<?php
$args = [
	'post_type' => 'slider',
    'order'=>'ASC',
	'orderby'   => 'meta_value_num',
	'meta_key'  => 'slider_number',
];

$slider = new WP_Query( $args );
?>

<section class="section-slider mb-3 ">

    <div class="container">
        <div class="col-lg-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
					<?php
					if ( $slider->have_posts() ) {
						while ( $slider->have_posts() ) {
							$slider->the_post(); ?>
                            <div class="carousel-item <?php
                            echo get_post_meta(get_the_ID(),'slider_number',true)=='1' ?  'active' : '' ?>">
                                <a href="<?= get_post_meta(get_the_ID(),'slider_url',true)?>">
                                    <img class="d-block w-100"
                                         src="<?= get_the_post_thumbnail_url() ?>"
                                         alt="First slide">
                                </a>
                            </div>
							<?php
						}
					}
					wp_reset_postdata();
					?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>
