<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$sites   = get_sites();
$error   = class_exists( 'umms\includes\Actions' ) ? \umms\includes\Actions::$error : '';
$success = class_exists( 'umms\includes\Actions' ) ? \umms\includes\Actions::$success : '';
?>

<form name="post" action="" method="post" class="umms-form">
	<input type="hidden" name="action" value="umms-widget">
	<?php wp_nonce_field( 'umms-widget' ); ?>

	<?php if ( $error ) : ?>
	<div class="umms-notice umms-notice-error"><?php echo esc_html( $error ); ?></div>
	<?php endif; ?>

	<?php if ( $success ) : ?>
	<div class="umms-notice umms-notice-success"><?php echo esc_html( $success ); ?></div>
	<?php endif; ?>

	<p><?php esc_html_e( 'Transfer users and their photos', 'um-multisite' ); ?></p>

	<div class="umms-field">
		<label for="umms-from" class="label"><?php esc_html_e( 'From site', 'um-multisite' ); ?></label>
		<select name="umms-from">
			<?php foreach ( $sites as $site ) { ?>
			<option value="<?php echo esc_attr( $site->blog_id ); ?>"><?php echo esc_html( $site->blogname ); ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="umms-field">
		<label for="umms-to" class="label"><?php esc_html_e( 'To site', 'um-multisite' ); ?></label>
		<select name="umms-to">
			<?php foreach ( $sites as $site ) { ?>
			<option value="<?php echo esc_attr( $site->blog_id ); ?>"><?php echo esc_html( $site->blogname ); ?></option>
			<?php } ?>
		</select>
	</div>

	<p class="submit">
		<input type="submit" name="umms-transfer" id="umms-transfer" class="button button-primary" value="<?php esc_attr_e( 'Transfer', 'um-multisite' ); ?>">
	</p>

	<hr>

	<p><?php esc_html_e( 'Transfer users from the main site to all subsites.', 'um-multisite' ); ?></p>
	<p><?php esc_html_e( 'Copy users photos from sites to the common uploads directory.', 'um-multisite' ); ?></p>

	<p class="submit">
		<input type="submit" name="umms-sync" id="umms-sync" class="button button-primary" value="<?php esc_attr_e( 'Sync', 'um-multisite' ); ?>">
	</p>
</form>
