<?php
// The options wp.getOptions describes: read-only facts such as the software version and URLs, and writable settings; xmlrpc_blog_options filters the list.
function guide_blog_options( $options ) {
	return $options + array( 'guide' => array( 'desc' => 'Guide', 'readonly' => true, 'value' => 1 ) );
}
add_filter( 'xmlrpc_blog_options', 'guide_blog_options' );
$server = new wp_xmlrpc_server();
$options = $server->blog_options;
return array( array_keys( array_filter( $options, fn( $o ) => $o['readonly'] ) ), array_keys( array_filter( $options, fn( $o ) => ! $o['readonly'] ) ), $options['software_version'], $options['blog_url'] );
