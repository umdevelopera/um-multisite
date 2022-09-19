<?php
/**
 * Plugin Name: Ultimate Member - Multisite
 * Description: Sync members between sites on multisite installation.
 * Version:     1.0.0
 * Author:      Ultimate Member support
 * Author URI:  https://ultimatemember.com/support/
 * Text Domain: um-multisite
 * UM version:  2.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Works on multisite installetion only.
if ( ! is_multisite() ) {
	return;
}

// The Ultimate Member plugin is required.
if ( ! function_exists( 'UM' ) ) {
	return;
}

// When users register on the main site they will be added to all subsites.
include_once __DIR__ . '/includes/hooks-register.php';

// Changed the directory for users uploads.
include_once __DIR__ . '/includes/hooks-uploader.php';

// Add dashboard widget.
if ( is_admin() ) {
	require_once wp_normalize_path( __DIR__ . '/includes/class-widget.php' );
	new umms\includes\Widget();
}

// Handle actions.
if ( is_admin() && isset( $_POST['action'] ) ) {
	require_once wp_normalize_path( __DIR__ . '/includes/class-actions.php' );
	new umms\includes\Actions();
}