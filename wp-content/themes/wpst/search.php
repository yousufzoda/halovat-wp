<?php
/**
 * The template for displaying search results pages
 *
 */

// the query

$paged = $_GET['page'] ? $_GET['page'] : 1;

$args      = array(
	'post_type'      => 'food',
	'posts_per_page' => 15,
	'offset'         => ( $paged - 1 ) * 15,
	'paged'          => $paged,
	'meta_query'     => array(
		array(
			'key'     => 'food_tags',
			'value'   => $_GET['s'],
			'compare' => 'LIKE',
		),
	),
);
$the_query = new WP_Query( $args );

$args  = array(
	'hide_empty' => false,
	'meta_query' => array(
		array(
			'key'     => 'tagsResturant',
			'value'   => $_GET['s'],
			'compare' => 'LIKE'
		)
	),
	'taxonomy'   => 'resturants',
);
$terms = get_terms( $args );
?>
<?php get_header(); ?>

<?php View::render( 'sections/navbar' ) ?>

<section class="section-main" style="margin-top: 5rem">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-9">
                <h2 class="text-secondary">Поиск : </h2>

				<?php get_search_form() ?>

				<?php
				if ( count( $terms ) > 0 ) {
					echo '<h3 class="default-color"> Рестораны : </h3>';
				}
				foreach ( $terms as $term ): ?>
                    <div class="card mb-3">
                        <a href="/foods_items?restaurant=<?= $term->slug ?>" class="text-dark">
                            <div class="row no-gutters">
                                <div class="col-md-4" style="overflow: hidden">
                                    <div class="card-img-wrapper">
                                        <img class="card-img-top"
                                             src="<?= get_term_meta( $term->term_id, 'ImageResturant', true ) ?>"
                                             alt="Card image cap">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-1 d-flex justify-content-between flex-column">
                                        <h5 class="card-title m-1"><?= $term->name ?></h5>
                                        <p class="card-text m-1"><?= wp_trim_words( get_term_meta( $term->term_id, 'aboutResturant', true ), 16 ) ?>
                                        </p>
                                        <p class="text-danger font-weight-bold m-1 p-0">Время работа
                                            : <?= $term->description ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

				<?php endforeach; ?>
				<?php if ( $the_query->have_posts() ) : ?>
                    <h3 class="default-color"> Блюды : </h3>

                    <!-- pagination here -->

                    <!-- the loop -->
                    <div class="card-columns">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <div class="card">
                                <div class="card-img-wrapper">
                                    <img src="<?= the_post_thumbnail_url() ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mt-1"><?= the_title() ?></h5>
                                    <p class="card-text text-muted"> Состав :
										<?= get_post_meta( get_the_ID(), 'food_makeup', true ) ?>
                                    </p>
                                </div>
                                <div class="card-footer p-2">
                                    <div class="buy d-flex justify-content-between align-items-center">
                                        <div class="price text-danger"><h5 class="mt-2" title="Цена">
                                                <span class="text-dark">Цена : </span>
												<?= number_format( get_post_meta( get_the_ID(), 'food_price', true ), 2 ) ?>
                                                c.
                                            </h5></div>
                                        <button class="btn btn-sm btn-success rounded mt-1"
                                                onclick="
                                                        window.location.href =
                                                        '<?php echo home_url() . '/foods_items/?restaurant=' . wp_get_post_terms( get_the_ID(), 'resturants' )[0]->slug ?>';
                                                        setOrIncr(
										        <?php echo get_the_ID() ?>,
                                                        '<?php echo get_the_title() ?>',
                                                        '<?= number_format( get_post_meta( get_the_ID(), 'food_price', true ), 2 ) ?>',
                                                        '<?php echo wp_get_post_terms( get_the_ID(), 'resturants' )[0]->slug ?>');
                                                        ">
                                            <ion-icon name="cart"></ion-icon>
                                        </button>
                                    </div>

                                </div>
                            </div>

						<?php endwhile; ?>
                    </div>
                    <!-- end of the loop -->

                    <!-- pagination here -->

					<?php wp_reset_postdata(); ?>

				<?php else : ?>
                    <p><?php _e( 'Извините, по Вашему запросу ничего не найдена!' ); ?></p>
				<?php endif; ?>



				<?php
				$page_count = $the_query->max_num_pages;
				if ( $page_count > 1 ): ?>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo $paged == 1 ? 'disabled' : '' ?>">
                                <a class="page-link"
                                   href="/<?= 'page/' . ( $paged - 1 ) . '/?s=' . $_GET['s'] ?>"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
							<?php for ( $i = 1; $i <= $page_count; $i ++ ):
								?>
                                <li class="page-item <?php
								echo $paged == $i ? ' active ' : ''; ?>">
                                    <a class="page-link"
                                       href="/<?= 'page/' . $i . '/?s=' . $_GET['s'] ?>"><?= $i ?></a>
                                </li>
							<?php endfor; ?>
                            <li class="page-item <?php echo $paged == $page_count ? 'disabled' : '' ?>">
                                <a class="page-link"
                                   href="/<?= 'page/' . ( $paged + 1 ) . '/?s=' . $_GET['s'] ?>"
                                   aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

				<?php endif; ?>
				
            </div>
			<?php View::render( 'sections/aside' ) ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

