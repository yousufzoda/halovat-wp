<?php


class Basket {
	public static function getFood( $id ) {
		$food = get_post( $id );
		return $food;
	}

	public static function initBasket() {
		if ( ! isset( $_SESSION['basket'] ) ) {
			$_SESSION['basket'] = [];
		}
	}

	public static function add( $id ) {
		self::initBasket();
		$food                               = self::getFood( $id );
		$_SESSION['basket']['items'][ $id ] = [
			'id'    => $id,
			'title' => $food->post_title,
			'price' => get_post_meta( $id, 'food_price', true ),
			'count' => 1
		];
	}

	public static function remove( $id ) {
		if ( self::foodExist( $id ) ) {
			unset( $_SESSION['basket']['items'][ $id ] );
		}
	}

	public static function foodExist( $id ) {
		return isset( $_SESSION['basket']['items'][ $id ] );
	}

	public static function incrFood( $id ) {
		if ( self::foodExist( $id ) ) {
			$_SESSION['basket']['items'][ $id ]['count'] ++;
		}
	}

	public static function decrFood( $id ) {
		if ( self::foodExist( $id ) ) {
			if ( $_SESSION['basket']['items'][ $id ]['count'] == 1 ) {
				self::remove( $id );
			} else {
				$_SESSION['basket']['items'][ $id ]['count'] --;
			}
		}
	}

}