<?php /* Template Name: checkout Template */
//$restaurant =


?>


<?php get_header(); ?>

<?php View::render( 'sections/navbar' ) ?>

    <section class="section-checkout" style="margin-top: 70px">
        <div class="container">

            <h3>Vasha invoys</h3>
            <div class="table-responsive">
                <table class="table table-info table-striped table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>

					<?php
					$i   = 0;
					$sum = 0;
					foreach ( $_POST as $key => $value ):
						$i ++;
						$post  = get_post( $key );
						$price = get_post_meta( $key, 'food_price', true );
						$sum   += $price * $value;
						?>
                        <tr>
                            <td class="text-secondary"><?= $i ?>  </td>
                            <td class="font-weight-bold"><?= $post->post_title ?>  </td>
                            <td class="text-center"><?= $value ?>  </td>
                            <td><?= number_format( $price, 2 ) ?> c.</td>
                            <td class="text-danger font-weight-bold"><?= number_format( $price * $value, 2 ) ?> c.</td>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-right font-weight-bold text-danger" colspan="5">
                            <?= 'Итого : '. number_format($sum,2) . ' c.'?>
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </section>

<?php get_footer(); ?>