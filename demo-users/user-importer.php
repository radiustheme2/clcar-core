<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class ClCar_Core_Demo_User_Import {

	public $user_migration = [];

	public function __construct() {
		$this->import_users();
		$this->import_usermeta();
		$this->update_authors_in_post_and_postmeta();
	}

	public function import_users() {
		global $wpdb;

		$existing_users     = [];
		$existing_users_obj = get_users( [ 'number' => - 1, 'fields' => [ 'ID', 'user_login' ] ] );
		foreach ( $existing_users_obj as $existing_user ) {
			$existing_users[ $existing_user->user_login ] = $existing_user->ID;
		}

		$user_data = file_get_contents( CLCAR_CORE_BASE_DIR . 'demo-users/users.json' );
		$user_data = json_decode( $user_data, true );

		$_user_migration = [];
		foreach ( $user_data as $user_value ) {
			if ( array_key_exists( $user_value['user_login'], $existing_users ) ) {
				//continue;
				require_once( ABSPATH . 'wp-admin/includes/user.php' );
				wp_delete_user( $existing_users[$user_value['user_login']] );
			}

			$old_id = $user_value['ID'];
			unset( $user_value['ID'] );
			if ( $wpdb->insert( $wpdb->users, $user_value ) ) {
				$_user_migration[ $old_id ] = $wpdb->insert_id;
			}
		}

		update_option( 'clcar_users', $_user_migration );
	}

	public function import_usermeta() {
		global $wpdb;

		$user_meta_data = file_get_contents( CLCAR_CORE_BASE_DIR . 'demo-users/usermeta.json' );
		$user_meta_data = json_decode( $user_meta_data, true );

		$_clcar_users = get_option( 'clcar_users' );
		foreach ( $user_meta_data as $user_meta_value ) {
			if ( ! array_key_exists( $user_meta_value['user_id'], $_clcar_users ) ) {
				continue;
			}
			$user_meta_value['user_id']    = $_clcar_users[ $user_meta_value['user_id'] ];
			$user_meta_value['meta_value'] = maybe_unserialize( $user_meta_value['meta_value'] );

			// run update
			update_user_meta( $user_meta_value['user_id'], $user_meta_value['meta_key'], $user_meta_value['meta_value'] );
		}
	}

	public function update_authors_in_post_and_postmeta() {
		$_clcar_users = get_option( 'clcar_users' );

		//Update Listing author : Listing_id => user_id
		$existing_post_authors = [

			236 => 2,		//rebeccahasan

			269 => 2,		//rebeccahasan

			276 => 3,		//jamesharper

			283 => 3,		//jamesharper

			292 => 3,		//jamesharper

			300 => 4,		//kieraiqbal

			306 => 4,		//kieraiqbal

			313 => 4,		//kieraiqbal

			319 => 4,		//kieraiqbal

			340 => 2,		//rebeccahasan

			424 => 3		//jamesharper

		];

		foreach ( $existing_post_authors as $post_id => $user_id ) {
			if ( ! array_key_exists( $user_id, $_clcar_users ) ) {
				continue;
			}
			@wp_update_post( [ 'ID' => $post_id, 'post_author' => $_clcar_users[ $user_id ] ] );
			update_post_meta( $post_id, '_rtcl_manager_id', $_clcar_users[ $user_id ] );
		}

		

		//Update Store Meta : store_id => user_id
		$existing_store_ids = [
			266 => 2,
			274 => 3,
			298 => 4,
			444 => 5,
		];

		foreach ( $existing_store_ids as $store_id => $user_id ) {
			if ( ! array_key_exists( $user_id, $_clcar_users ) ) {
				continue;
			}
			update_post_meta( $store_id, '_rtcl_manager_ids', $_clcar_users[ $user_id ] );
			update_post_meta( $store_id, 'store_owner_id', $_clcar_users[ $user_id ] );
		}
	}


	public static function export_users() {
		global $wpdb;
		$users_id = [ 2, 3, 4, 5];

		$users_id_sql = implode( ',', $users_id );

		// user table
		$query = "SELECT * FROM $wpdb->users WHERE ID IN ($users_id_sql)";
		$users = $wpdb->get_results( $query, ARRAY_A );

		// usermeta table
		$query     = "SELECT * FROM $wpdb->usermeta WHERE user_id IN ($users_id_sql)";
		$usermetas = $wpdb->get_results( $query, ARRAY_A );

		// json
		$json1 = json_encode( $users );
		$json2 = json_encode( $usermetas );
		file_put_contents( CLCAR_CORE_BASE_DIR . 'demo-users/users.json', $json1 );
		file_put_contents( CLCAR_CORE_BASE_DIR . 'demo-users/usermeta.json', $json2 );
	}

}