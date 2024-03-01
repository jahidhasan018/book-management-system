<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Create a class for the plugin
class BookManagement{
    // Version
    public $version;

    // Constructor
    public function __construct(){
        $this->version = BMS_VERSION;

        // Register admin menu 
        add_action( 'admin_menu', array( $this, 'bms_add_admin_menu' ) );

        // Enqueue scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'bms_enqueue_style_scripts' ) );
    }

    // Add admin menu method
    public function bms_add_admin_menu(){

        // Add a top-level admin menu
        add_menu_page(
            __( 'Book Management', 'bms' ),
            __( 'Book Management', 'bms' ),
            'manage_options',
            'book-management',
            array( $this, 'bms_book_list_callback' ),
            'dashicons-book-alt',
            14
        );

        // Add a submenu page under the top-level admin menu
        add_submenu_page(
            'book-management',
            __( 'Book List', 'bms' ),
            __( 'Book List', 'bms' ),
            'manage_options',
            'book-management',
            array( $this, 'bms_book_list_callback' )
        );

        // Add a submenu page under the top-level admin menu
        add_submenu_page(
            'book-management',
            __( 'Add New Book', 'bms'),
            __( 'Add New Book', 'bms'),
            'manage_options',
            'add-new-book',
            array( $this, 'bms_add_new_book_callback' )
        );

        // Add a submenu page under the top-level admin menu
        add_submenu_page(
            'book-management',
            __( 'Settings', 'bms'),
            __( 'Settings', 'bms'),
            'manage_options',
            'bms-settings',
            array( $this, 'bms_settings_callback' )
        );

    }

    // Book list page callback method
    public function bms_book_list_callback(){
        // use translation function here
        echo '<h1>' . get_admin_page_title() . '</h1>';
    }

    // Add new book page callback method
    public function bms_add_new_book_callback(){
        echo '<h1>' . get_admin_page_title() . '</h1>';
    }

    // Settings page callback method
    public function bms_settings_callback(){
        echo '<h1>' . get_admin_page_title() . '</h1>';
    }

    // Plugin activation method
    public function bms_on_plugin_activate(){
        global $wpdb;

        $table_name = $wpdb->prefix . 'bms_book_management';
        $collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE `$table_name` (
            `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(150) NOT NULL,
            `author` varchar(150) NOT NULL,
            `book_image` text NULL,
            `book_price` int(10) NULL,
            `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
        ) $collate ;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    // Enqueue scripts and styles method
    public function bms_enqueue_style_scripts(){
        // get current screen
        $screen = get_current_screen();
        $allowed_screens = array(
            'toplevel_page_book-management',
            'book-management_page_add-new-book',
            'book-management_page_bms-settings',
            'plugins'
        );
        var_dump($screen->id);
        // check if the current screen is in the allowed screens
        if( ! in_array( $screen->id, $allowed_screens ) ){
            return;
        }

        // Css
        wp_enqueue_style( 'bms-style', BMS_PLUGIN_URL . "assets/css/style.css", array(), $this->version, 'all' );

        // Js
        wp_enqueue_script( 'bms-script', BMS_PLUGIN_URL . "assets/js/script.js", array('jquery'), $this->version, false );
    }
}