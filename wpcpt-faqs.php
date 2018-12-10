<?php
/**
 * @package WPCPT_FAQS
 */
/*
Plugin Name: Custom Post Type: FAQs
Plugin URI: https://github.com/monkishtypist/wpcpt-faqs
Description: Adds custom post type for frequently asked questions (FAQs).
Version: 1.0.0
Author: @monkishtypist
Author URI: https://www.monkishtypist.com/
License: GPLv2 or later
Text Domain: mt_wpcpt_faqs
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'FAQs: a list of questions and answers relating to a particular subject, especially one giving basic information for users of a website.';
	exit;
}

define( 'MT_WPCPT_FAQS__VERSION', '1.0.0' );
define( 'MT_WPCPT_FAQS__MINIMUM_WP_VERSION', '4.0' );
define( 'MT_WPCPT_FAQS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MT_WPCPT_FAQS__TEXTDOMAIN', 'wpcpt-faqs' );

require_once( MT_WPCPT_FAQS__PLUGIN_DIR . 'class.wpcpt-faqs.php' );

load_plugin_textdomain( MT_WPCPT_FAQS__TEXTDOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages' );

$MT_WPCPT_FAQS = new MT_WPCPT_FAQS();
