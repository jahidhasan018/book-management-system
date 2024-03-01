<?php

// If this file is called directly, abort.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Remove the database table
global $wpdb;
$table_name = $wpdb->prefix . 'bms_book_management';

$wpdb->query( "DROP TABLE IF EXISTS $table_name" );