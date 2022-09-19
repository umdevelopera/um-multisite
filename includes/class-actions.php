<?php
/**
 * Handle actions.
 *
 * @package umms\includes
 */

namespace umms\includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Actions {

	public static $error;
	public static $success;

	public function __construct() {
		add_action( 'admin_action_umms-widget', array( &$this, 'do_action' ) );
	}

	public function action_transfer() {
		if ( empty( $_POST['umms-from'] ) ) {
			self::$error = esc_html__( 'You have to select the source site.', 'um-multisite' );
			return;
		}
		$from_id = absint( $_POST['umms-from'] );

		if ( empty( $_POST['umms-to'] ) ) {
			self::$error = esc_html__( 'You have to select the target site.', 'um-multisite' );
			return;
		}
		$to_id = absint( $_POST['umms-to'] );

		if ( $from_id === $to_id ) {
			self::$error = esc_html__( 'The source site matches the target site.', 'um-multisite' );
			return;
		}

		$from_dir = $this->get_blog_upload_dir( $from_id );
		$to_dir   = $this->get_blog_upload_dir( $to_id );

		$copied_files = $this->copy_dir( $from_dir, $to_dir );
		$copied_users = $this->copy_users( $from_id, $to_id );

		self::$success = sprintf( esc_html__( '%1$d users are added or updated. %2$d files are copied', 'um-multisite' ), $copied_users, $copied_files );
	}

	public function action_sync() {
		$copied_files = 0;
		$copied_users = 0;

		$main_site_id = get_main_site_id();
		$sites        = get_sites();

		$users = get_users(
			array(
				'blog_id' => $main_site_id,
				'fields'  => 'ids',
			)
		);

		foreach ( $sites as $site ) {
			$blog_id  = absint( $site->blog_id );
			$from_dir = $this->get_blog_upload_dir( $blog_id );
			$to_dir   = $this->get_commom_upload_dir();

			$copied_files += $this->copy_dir( $from_dir, $to_dir );

			if ( $main_site_id === $blog_id ) {
				continue;
			}

			foreach ( $users as $user_id ) {
				if ( $this->add_user_to_blog( $site->blog_id, $user_id ) ) {
					$copied_users++;
				}
			}
		}

		self::$success = sprintf( esc_html__( '%1$d users are transfered to %2$d sites. %3$d users are added or updated in total. %4$d files are copied to the common uploads directory.', 'um-multisite' ), count( $users ), count( $sites ) - 1, $copied_users, $copied_files );
	}

	public function add_user_to_blog( $blog_id, $user_id ) {
		$user_role = UM()->roles()->get_priority_user_role( $user_id );
		$role      = $user_role && array_key_exists( $user_role, wp_roles()->role_names ) ? $user_role : 'subscriber';
		return add_user_to_blog( $blog_id, $user_id, $role );
	}

	public function copy_dir( $from_dir, $to_dir ) {
		$copied_files = 0;

		if ( ! is_dir( $from_dir ) ) {
			return false;
		}
		if ( ! is_dir( $to_dir ) ) {
			wp_mkdir_p( $to_dir );
		}

		$items = scandir( $from_dir );
		foreach ( $items as $item ) {
			if ( '.' === $item || '..' === $item ) {
				continue;
			}
			if ( is_dir( "$from_dir/$item" ) ) {
				$copied_files += $this->copy_dir( "$from_dir/$item", "$to_dir/$item" );
			}
			if ( is_file( "$from_dir/$item" ) ) {
				$from_file = wp_normalize_path( "$from_dir/$item" );
				$to_file   = wp_normalize_path( "$to_dir/$item" );

				if ( file_exists( $to_file ) ) {
					continue;
				}

				if ( copy( $from_file, $to_file ) ) {
					$copied_files++;
				}
			}
		}

		return $copied_files;
	}

	public function copy_users( $from_id, $to_id ) {
		$copied_users = 0;

		$users = get_users(
			array(
				'blog_id' => $from_id,
				'fields'  => 'ids',
			)
		);
		foreach ( $users as $user_id ) {
			if ( $this->add_user_to_blog( $to_id, $user_id ) ) {
				$copied_users++;
			}
		}

		return $copied_users;
	}

	public function get_blog_upload_dir( $blog_id ) {
		$upload_dir = wp_upload_dir();
		return wp_normalize_path( $upload_dir['basedir'] . "/sites/$blog_id/" . \UM()->uploader()->core_upload_dir );
	}

	public function get_commom_upload_dir() {
		$upload_dir = wp_upload_dir();
		return wp_normalize_path( $upload_dir['basedir'] . \UM()->uploader()->core_upload_dir );
	}

	public function do_action() {
		check_admin_referer( 'umms-widget' );

		if ( ! empty( $_POST['umms-transfer'] ) ) {
			$this->action_transfer();
		}

		if ( ! empty( $_POST['umms-sync'] ) ) {
			$this->action_sync();
		}
	}
}
