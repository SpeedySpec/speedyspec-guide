<?php
// When WordPress can't write files as itself, the method isn't "direct", and writing needs credentials from a form.
require_once ABSPATH . 'wp-admin/includes/file.php';

function guide_pretend_files_belong_to_someone_else( $method ) {
	return 'ftpext'; // What get_filesystem_method() chooses when PHP doesn't own the files it would write.
}

$normally = get_filesystem_method();
add_filter( 'filesystem_method', 'guide_pretend_files_belong_to_someone_else' );
ob_start();
$credentials = request_filesystem_credentials( admin_url( 'tools.php?page=my-plugin' ) ); // Prints a form, returns false.
$form = ob_get_clean();
return array(
	'normally'        => $normally,
	'here'            => get_filesystem_method(),
	'credentials'     => $credentials,
	'asks for'        => preg_match_all( '/<input[^>]+name="(hostname|username|password)"/', $form, $m ) ? $m[1] : array(),
);
