<?php
/**
 * @package WPCPT_FAQS
 */
/*
Plugin Name: WordPress FAQs Custom Post Type
Plugin URI: https://github.com/monkishtypist/wpcpt-faqs
Description: Creates custom post type for Frequently Asked Questions. Includes additional settings and features imbedding in pages.
Version: 0.1
Author: @monkishtypist
Author URI: https://www.monkishtypist.com/
License: GPLv2 or later
Text Domain: wpcpt_faqs
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'FAQs: a list of questions and answers relating to a particular subject, especially one giving basic information for users of a website.';
	exit;
}

define( 'WPCPT_FAQS__VERSION', '0.1' );
define( 'WPCPT_FAQS__MINIMUM_WP_VERSION', '4.0' );
define( 'WPCPT_FAQS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPCPT_FAQS__TEXTDOMAIN', 'wpcpt-faqs' );

require_once( WPCPT_FAQS__PLUGIN_DIR . 'class.wpcpt-faqs.php' );
