<?php


class MetaBoxes {

	public static function registerFoodPrice() {
		add_meta_box( 'foodPrice', 'Price', 'MetaBoxes::contentHandlerFoodPrice', 'food' );
	}

	public static function contentHandlerFoodPrice( $post ) {
		$price = (float) get_post_meta( $post->ID, 'food_price', true );
		View::renderWithPassData( 'admin/metabox/food/food_price', [ 'post_price' => $price ] );
	}

	public static function saveFoodPrice( $post_id ) {
		//

		if ( isset( $_POST['food_price'] ) ) {
			update_post_meta( $post_id, 'food_price', $_POST['food_price'] );
		}
	}


	public static function registerFoodTags() {
		add_meta_box( 'foodTags', 'Tags', 'MetaBoxes::contentHandlerFoodTags', 'food' );
	}

	public static function contentHandlerFoodTags( $post ) {
		$tags = get_post_meta( $post->ID, 'food_tags', true );
		View::renderWithPassData( 'admin/metabox/food/food_tags', [ 'post_tags' => $tags ] );
	}

	public static function saveFoodTags( $post_id ) {
		//

		if ( isset( $_POST['food_tags'] ) ) {
			update_post_meta( $post_id, 'food_tags', $_POST['food_tags'] );
		}
	}


	public static function registerFoodMakeup() {
		add_meta_box( 'foodMakeup', 'Tarkibot', 'MetaBoxes::contentHandlerFoodMakeup', 'food' );
	}

	public static function contentHandlerFoodMakeup( $post ) {
		$makeup = get_post_meta( $post->ID, 'food_makeup', true );
		View::renderWithPassData( 'admin/metabox/food/food_makeup', [ 'post_makeup' => $makeup ] );
	}

	public static function saveFoodMakeup( $post_id ) {

		if ( isset( $_POST['food_makeup'] ) ) {
			update_post_meta( $post_id, 'food_makeup', $_POST['food_makeup'] );
		}
	}


	public static function registerSliderNum() {
		add_meta_box( 'sliderNum', 'Number', 'MetaBoxes::contentHandlerSliderNum', 'slider' );
	}

	public static function contentHandlerSliderNum( $post ) {
		$number = get_post_meta( $post->ID, 'slider_number', true );
		View::renderWithPassData( 'admin/metabox/slider/number', [ 'number' => $number ] );
	}

	public static function saveSliderNum( $post_id ) {

		if ( isset( $_POST['slider_number'] ) ) {
			update_post_meta( $post_id, 'slider_number', $_POST['slider_number'] );
		}
	}


	public static function registerSliderUrl() {
		add_meta_box( 'sliderUrl', 'URL', 'MetaBoxes::contentHandlerSliderUrl', 'slider' );
	}

	public static function contentHandlerSliderUrl( $post ) {
		$number = get_post_meta( $post->ID, 'slider_url', true );
		View::renderWithPassData( 'admin/metabox/slider/url', [ 'url' => $number ] );
	}

	public static function saveSliderUrl( $post_id ) {

		if ( isset( $_POST['slider_url'] ) ) {
			update_post_meta( $post_id, 'slider_url', $_POST['slider_url'] );
		}
	}


	public static function registerImageRestaurant() {
		?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text">Aksi Asosi</label>
            <input type="text" name="imageResturant" id="term-meta-text" value="http://halovat.tj/wp-content/uploads/2020/02/02.jpg" class="term-meta-text-field"/>
        </div>
		<?php
	}

	public static function editImageRestaurant( $term ) {
		$value = get_term_meta( $term->term_id, 'ImageResturant', true );
		if ( ! $value ) {
			$value = "";
		} ?>
        <tr class="form-field term-meta-text-wrap">
            <th scope="row"><label for="term-meta-text">Aksi Asosi</label></th>
            <td>
                <input type="text" name="imageResturant" id="term-meta-text" value="<?php echo esc_attr( $value ); ?>"
                       class="term-meta-text-field"/>
            </td>
        </tr>
	<?php }

	public static function SaveResturantImage( $term_id ) {
		$old_value = get_term_meta( $term_id, 'ImageResturant', true );
		$new_value = isset( $_POST['imageResturant'] ) ? sanitize_text_field( $_POST['imageResturant'] ) : '';
		if ( $old_value && '' === $new_value ) {
			delete_term_meta( $term_id, 'ImageResturant' );
		} else if ( $old_value !== $new_value ) {
			update_term_meta( $term_id, 'ImageResturant', $new_value );
		}
	}

	public static function registerCategoriesRestaurant() {
		?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text">Categories</label>
            <textarea rows="4" type="text" name="resturantCat" id="term-meta-text"
                      class="term-meta-text-field"></textarea>
        </div>
		<?php
	}

	public static function editCategoriesRestaurant( $term ) {
		$value = get_term_meta( $term->term_id, 'resturantCat', true );
		if ( ! $value ) {
			$value = "";
		} ?>
        <tr class="form-field term-meta-text-wrap">
            <th scope="row"><label for="term-meta-text">Categoties</label></th>
            <td>
                <textarea type="text" rows="3" name="resturantCat" id="term-meta-text"
                          class="term-meta-text-field"><?php echo esc_attr( $value ); ?></textarea>
            </td>
        </tr>
	<?php }

	public static function SaveResturantCategories( $term_id ) {
		$old_value = get_term_meta( $term_id, 'resturantCat', true );
		$new_value = isset( $_POST['resturantCat'] ) ? sanitize_text_field( $_POST['resturantCat'] ) : '';
		if ( $old_value && '' === $new_value ) {
			delete_term_meta( $term_id, 'resturantCat' );
		} else if ( $old_value !== $new_value ) {
			update_term_meta( $term_id, 'resturantCat', trim( $new_value ) );
		}
	}


	public static function registerBigImageRestaurant() {
		?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text">Aksi Kalon</label>
            <input type="text" name="BigImageResturant" id="term-meta-text" value="http://halovat.tj/wp-content/uploads/2020/02/01.jpg" class="term-meta-text-field"/>
        </div>
		<?php
	}

	public static function editBigImageRestaurant( $term ) {
		$value = get_term_meta( $term->term_id, 'BigImageResturant', true );
		if ( ! $value ) {
			$value = "";
		} ?>
        <tr class="form-field term-meta-text-wrap">
            <th scope="row"><label for="term-meta-text">Aksi Kalon</label></th>
            <td>
                <input type="text" name="BigImageResturant" id="term-meta-text"
                       value="<?php echo esc_attr( $value ); ?>"
                       class="term-meta-text-field"/>
            </td>
        </tr>
	<?php }

	public static function SaveBigResturantImage( $term_id ) {
		$old_value = get_term_meta( $term_id, 'BigImageResturant', true );
		$new_value = isset( $_POST['BigImageResturant'] ) ? sanitize_text_field( $_POST['BigImageResturant'] ) : '';
		if ( $old_value && '' === $new_value ) {
			delete_term_meta( $term_id, 'BigImageResturant' );
		} else if ( $old_value !== $new_value ) {
			update_term_meta( $term_id, 'BigImageResturant', $new_value );
		}
	}


	public static function registerTagsRestaurant() {
		?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text">Tags</label>
            <input type="text" name="tagsResturant" id="term-meta-text" value="" class="term-meta-text-field"/>
        </div>
		<?php
	}

	public static function editTagsRestaurant( $term ) {
		$value = get_term_meta( $term->term_id, 'tagsResturant', true );
		if ( ! $value ) {
			$value = "";
		} ?>
        <tr class="form-field term-meta-text-wrap">
            <th scope="row"><label for="term-meta-text">Tags</label></th>
            <td>
                <input type="text" name="tagsResturant" id="term-meta-text" value="<?php echo esc_attr( $value ); ?>"
                       class="term-meta-text-field"/>
            </td>
        </tr>
	<?php }

	public static function SaveTagsResturant( $term_id ) {
		$old_value = get_term_meta( $term_id, 'tagsResturant', true );
		$new_value = isset( $_POST['tagsResturant'] ) ? sanitize_text_field( $_POST['tagsResturant'] ) : '';
		if ( $old_value && '' === $new_value ) {
			delete_term_meta( $term_id, 'tagsResturant' );
		} else if ( $old_value !== $new_value ) {
			update_term_meta( $term_id, 'tagsResturant', $new_value );
		}
	}


	public static function registerAboutRestaurant() {
		?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text">About</label>
            <textarea rows="5" name="aboutResturant" id="term-meta-text" value=""
                      class="term-meta-text-field"></textarea>
        </div>
		<?php
	}

	public static function editAboutRestaurant( $term ) {
		$value = get_term_meta( $term->term_id, 'aboutResturant', true );
		if ( ! $value ) {
			$value = "";
		} ?>
        <tr class="form-field term-meta-text-wrap">
            <th scope="row"><label for="term-meta-text">About</label></th>
            <td>
                <textarea rows="5"  name="aboutResturant" id="term-meta-text"
                          class="term-meta-text-field"><?php echo esc_attr( $value ); ?></textarea>
            </td>
        </tr>
	<?php }

	public static function SaveAboutResturant( $term_id ) {
		$old_value = get_term_meta( $term_id, 'aboutResturant', true );
		$new_value = isset( $_POST['aboutResturant'] ) ? sanitize_text_field( $_POST['aboutResturant'] ) : '';
		if ( $old_value && '' === $new_value ) {
			delete_term_meta( $term_id, 'aboutResturant' );
		} else if ( $old_value !== $new_value ) {
			update_term_meta( $term_id, 'aboutResturant', $new_value );
		}
	}
	
	public static function registerIsTopRestaurant(){
	    ?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text">Is top</label>
            <input type='checkbox'  name="isTop" id="term-meta-text" value="1"
                      class="term-meta-text-field"/>
        </div>
		<?php
	}
	
	public static function editIsTopRestaurant( $term ) {
		$value = get_term_meta( $term->term_id, 'isTop', true );
		if ( ! $value ) {
			$value = "";
		} ?>
        <tr class="form-field term-meta-text-wrap">
            <th scope="row"><label for="term-meta-text">Is Top</label></th>
            <td>
                <input type='checkbox'  name="isTop" id="term-meta-text" value="1" <?php echo $value == 1 ? 'checked' : '0'  ?>
                      class="term-meta-text-field"/>
            </td>
        </tr>
	<?php }

	public static function SaveIsTopRestaurant( $term_id ) {
		$old_value = get_term_meta( $term_id, 'isTop', true );
		$new_value = isset( $_POST['isTop'] ) ? sanitize_text_field( $_POST['isTop'] ) : '';
		if ( $old_value && '' === $new_value ) {
			delete_term_meta( $term_id, 'isTop' );
		} else if ( $old_value !== $new_value ) {
			update_term_meta( $term_id, 'isTop', $new_value );
		}
	}


}
