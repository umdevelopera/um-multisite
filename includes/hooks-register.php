<?php


/**
 * When users register on one site they will be added to all sites.
 *
 * @param int   $user_id User ID.
 * @param array $args    Form data.
 */
function um_add_user_to_all_blogs( $user_id, $args ) {
	$blog_id = get_current_blog_id();
	$sites   = get_sites();

	$user_role  = UM()->roles()->get_priority_user_role( $user_id );
	$blog_roles = wp_roles()->role_names;
	$role       = array_key_exists( $user_role, $blog_roles ) ? $user_role : 'subscriber';

	foreach ( $sites as $site ) {
		if ( $blog_id === (int) $site->blog_id) {
			continue;
		}
		add_user_to_blog( $site->blog_id, $user_id, $role );
	}
}

add_action( 'um_registration_complete', 'um_add_user_to_all_blogs', 20, 2 );
