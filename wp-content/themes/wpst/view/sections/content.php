<div class="   col-md-12 col-lg-9">
    <?php get_search_form() ?>
    <h1 class="default-color">Рестораны</h1>
    <div class="row">

		<?php
		if(isset($_GET['sah'])){
		    $page  = $_GET['sah'];
		}else{
		    $page = 1;
		}
		
	//	$page       = $_GET['sah'] ? $_GET['sah'] : 1;
		$per_page   = 15;
		$resturants = get_terms( [
			'taxonomy'   => 'resturants',
			'hide_empty' => false
		] );
		$term_count = count( $resturants );
		$resturants = get_terms( [
			'taxonomy'   => 'resturants',
			'hide_empty' => false,
			'number'     => $per_page,
			'offset'     => ( $page - 1 ) * $per_page
		] );
		 
	
		if ( $resturants ) {
			foreach ( $resturants as $resturant ) {
			    	$image = get_term_meta( $resturant->term_id, 'ImageResturant', true ) ?  get_term_meta( $resturant->term_id, 'ImageResturant', true ) : 'http://halovat.tj/wp-content/uploads/2020/02/02.jpg';
				?>
                <div class="col-12 col-sm-6 col-md-4  mb-3">
                    <div class="card">
                        <a href="/foods_items?restaurant=<?= $resturant->slug ?>" class="text-dark">
                            <div class="card-img-wrapper">
                                <img class="card-img-top"
                                     src="<?= $image ?>"
                                     alt="Card image cap">
                            </div>
                            <div class="card-body mt-1">
                                <h5 class="card-title h5"><?= $resturant->name ?></h5>
                                <p class="card-text"> Время работы : <?= $resturant->description ?></p>
                            </div>
                        </a>
                    </div>
                </div>
				<?php
			}
		}

		$page_count = intval( $term_count % 2 == 1 ? $term_count / $per_page + 1 : $term_count / $per_page )+1;
		?>

    </div>

	<?php if ( $page_count > 1 ): ?>

        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="/?sah=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
				<?php for ( $i = 1; $i <= $page_count; $i ++ ):
					?>
                    <li class="page-item <?php
					echo $page == $i ? ' active ' : ''; ?>">
                        <a class="page-link" href="/?sah=<?= $i ?>"><?= $i ?></a>
                    </li>
				<?php endfor; ?>
                <li class="page-item <?php echo $page == $page_count ? 'disabled' : '' ?>">
                    <a class="page-link" href="/?sah=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>

	<?php endif; ?>
</div>
