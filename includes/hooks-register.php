<?php


/**
 * When users register on the main site they will be added to all subsites.
 *
 * @param int   $user_id User ID.
 * @param array $args    Form data.
 */
function um_add_user_to_all_blogs( $user_id, $args ) {
	// Skip if current site is not a main site.
	if ( ! is_main_site() ) {
		return;
	}

	$user_role  = UM()->roles()->get_priority_user_role( $user_id );
	$blog_roles = wp_roles()->role_names;
	$role       = array_key_exists( $user_role, $blog_roles ) ? $user_role : 'subscriber';

	$sites = get_sites();
	foreach ( $sites as $site ) {
		add_user_to_blog( $site->blog_id, $user_id, $role );
	}
}

add_action( 'um_registration_complete', 'um_add_user_to_all_blogs', 20, 2 );
