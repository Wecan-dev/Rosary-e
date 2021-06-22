<?php

/**
 * Prevent direct access to the script.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wss_db_version;
$wss_db_version = '1.0';

function wss_create_db_table() {
	global $wpdb;
	global $wss_db_version;

	$table_name = $wpdb->prefix . 'wss_log';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		product_id bigint(20) unsigned,
		type varchar(255) default '',
		message text,
		data longtext,
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'wss_db_version', $wss_db_version );
}
