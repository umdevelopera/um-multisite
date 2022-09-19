<?php

/**
 * Change the user basedir and baseurl.
 *
 * @param  array $args Array of information about the upload directory.
 * @return array       Array of information about the upload directory.
 */
function um_set_common_upload_directory( $args ) {
	$uploader = UM()->classes['uploader'];

	$uploader->wp_upload_dir['baseurl'] = preg_replace( '~/sites/\d+~', '', $args['baseurl'] );
	$uploader->wp_upload_dir['basedir'] = preg_replace( '~/sites/\d+~', '', $args['basedir'] );

	$uploader->upload_baseurl = $uploader->wp_upload_dir['baseurl'] . $uploader->core_upload_url;
	$uploader->upload_basedir = $uploader->wp_upload_dir['basedir'] . $uploader->core_upload_dir;

	if ( 'image' === $uploader->upload_type && is_user_logged_in() ) {
		if ( 'stream_photo' === $uploader->upload_image_type ) {
			$uploader->upload_user_baseurl = $uploader->upload_baseurl . $uploader->temp_upload_dir;
			$uploader->upload_user_basedir = $uploader->upload_basedir . $uploader->temp_upload_dir;
		} else {
			$uploader->upload_user_baseurl = $uploader->upload_baseurl . $uploader->user_id;
			$uploader->upload_user_basedir = $uploader->upload_basedir . $uploader->user_id;
		}
	} else {
		$uploader->upload_user_baseurl = $uploader->upload_baseurl . $uploader->temp_upload_dir;
		$uploader->upload_user_basedir = $uploader->upload_basedir . $uploader->temp_upload_dir;
	}

	list( $uploader->upload_user_baseurl, $uploader->upload_user_basedir ) = apply_filters( 'um_change_upload_user_path', array( $uploader->upload_user_baseurl, $uploader->upload_user_basedir ), $uploader->field_key, $uploader->upload_type );

	if ( $uploader->replace_upload_dir ) {
		$args['path'] = $uploader->upload_user_basedir;
		$args['url']  = $uploader->upload_user_baseurl;
	}

	return $args;
}

UM()->uploader();
remove_filter( 'upload_dir', array( UM()->uploader(), 'set_upload_directory' ), 10 );
add_filter( 'upload_dir', 'um_set_common_upload_directory', 10, 1 );
wp_upload_dir();
