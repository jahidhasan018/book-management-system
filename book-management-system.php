<?php

// Plugin Header
/*
Plugin Name: Book Management System
Plugin URI: http://www.example.com
Description: This is a book management system that allows you to manage your books.
Version: 1.0
Author: Jahid Hossain
Author URI: http://www.example.com
Text Domain: bms
Requires PHP: 7.4
Requires at least: 6.0
License: GPLv2
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

// Define Constants
define( 'BMS_VERSION', '1.0' );
define( 'BMS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BMS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'BMS_BASENAME', plugin_basename( __FILE__ ) );

// Include the main class
require_once BMS_PLUGIN_DIR . 'class/BookManagement.php';

// Initialize the plugin
$book_management = new BookManagement();

// Register activation hook
register_activation_hook( __FILE__, array( $book_management, 'bms_on_plugin_activate' ) );