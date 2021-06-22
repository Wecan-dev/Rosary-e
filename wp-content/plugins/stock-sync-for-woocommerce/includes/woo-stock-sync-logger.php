<?php

/**
 * Prevent direct access to the script.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woo_Stock_Sync_Logger {
	/**
	 * Get table name
	 */
	private static function table() {
		global $wpdb;

		return $wpdb->prefix . 'wss_log';
	}

	/**
	 * Check if log table exists
	 */
	public static function table_exists() {
		global $wpdb;

		$table = self::table();

		return $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) == $table;
	}

	/**
	 * Insert log message
	 */
	public static function log( $message, $type = 'default', $product_id = null, $data = null ) {
		global $wpdb;

		$wpdb->insert( 
			self::table(), 
			[
				'product_id' => $product_id, 
				'type' => $type, 
				'message' => $message, 
				'data' => json_encode( $data ),
				'created_at' => date( 'Y-m-d H:i:s' ),
			],
			[ 
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
			] 
		);

		return $wpdb->insert_id;
	}

	/**
	 * Update log message about whether or not site syncing succeeded
	 */
	public static function log_update( $id, $site_key, $result, $errors = [] ) {
		$record = self::get( $id );

		if ( $record ) {
			if ( ! isset( $record->data->sync_results ) ) {
				$record->data->sync_results = [];
			}

			// Cast to array
			$record->data->sync_results = (array) $record->data->sync_results;

			$record->data->sync_results[$site_key] = [
				'result' => $result,
				'errors' => $errors,
			];

			self::update( $id, [
				'data' => $record->data,
			] );
		}
	}

	/**
	 * Insert log update into database
	 */
	public static function update( $id, $values ) {
		global $wpdb;

		$table = self::table();

		if ( isset( $values['data'] ) && ! is_scalar( $values['data'] ) ) {
			$values['data'] = json_encode( $values['data'] );
		}

		$wpdb->update(
			$table,
			$values,
			['id' => $id],
			'%s',
			'%d'
		);
	}

	/**
	 * Get single log record
	 */
	public static function get( $id ) {
		global $wpdb;

		$table = self::table();

		$query = $wpdb->prepare( 
			"SELECT * FROM {$table} WHERE id = %d",
			$id
		);

		$result = $wpdb->get_row( $query );

		if ( $result ) {
			$result = self::unserialize( $result );

			return $result;
		}

		return null;
	}

	/**
	 * Get log messages
	 */
	public static function get_all( $page, $per_page, $product_id = null ) {
		global $wpdb;

		$table = self::table();

		$offset = ( $page - 1 ) * $per_page;

		$query = $wpdb->prepare( 
			"SELECT * FROM {$table} ORDER BY id DESC LIMIT %d, %d",
			$offset,
			$per_page
		);

		if ( $product_id ) {
			$query = $wpdb->prepare( 
				"SELECT * FROM {$table} WHERE product_id = %d ORDER BY id DESC LIMIT %d, %d",
				$product_id,
				$offset,
				$per_page
			);
		}

		$results = $wpdb->get_results( $query );

		$results = array_map( function( $record ) {
			$record = self::unserialize( $record );

			return $record;
		}, $results );

		$total = $wpdb->get_var( "SELECT COUNT(*) FROM {$table}" );
		$max_num_pages = ceil( $total / $per_page );

		return (object) [
			'logs' => $results,
			'total' => $total,
			'max_num_pages' => $max_num_pages,
		];
	}

	/**
	 * Unserialize data in log record
	 */
	private static function unserialize( $record ) {
		if ( isset( $record->data ) && ! empty( $record->data ) ) {
			$record->data = json_decode( $record->data );
		} else {
			$record->data = [];
		}

		return $record;
	}
}
