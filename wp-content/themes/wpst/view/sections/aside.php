<?php
$args = array(
    'hide_empty' => false, 
     'taxonomy' => 'resturants',
    'meta_query' => array(
      array(
         'key'       => 'isTop',
         'value'     => '1',
         'compare'   => '='
      )
 ));
$restaurants = get_terms( $args );

?>
<div class="col-md-12 col-lg-3 border-left">
    <h4>ТОП рестораны </h4>

    <ul style="padding: 0">
        <?php
       
            foreach ( $restaurants as $rest) { 
	    	$image = get_term_meta( $resturant->term_id, 'ImageResturant', true ) ?  get_term_meta( $resturant->term_id, 'ImageResturant', true ) : 'http://halovat.tj/wp-content/uploads/2020/02/02.jpg';

            ?>
                <li class="media mb-3 pb-2 border-bottom">
                    <img class="d-flex mr-3 rounded-circle img-aside"
                         src="<?= $image ?>">
                    <div class="media-body">
                        <div class="row">
                            <div class="col-12">
                                <a href="/foods_items?restaurant=<?= $rest->slug ?>" class="text-danger"><?= $rest->name ?>    </a>
                            </div>
                            <div class="col-12">
                                <div class="m-0 p-0 lh-null"> 
                                
                                <div class="row">
                                    <div class="col-12">
                                         Время работы : 
                                    </div>
                                    <div class="col-12">
                                         <?= $rest->description ?>
                                    </div>
                                </div>
                              </div>
                            </div>
            
                        </div>

                    </div>
                </li>

                <?php
            }
        ?>


    </ul>

</div>