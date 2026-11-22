<?php
// wpdb talks to MySQL: prepare() builds a safe query from a template with %s, %d, %f and %i placeholders, the get_* methods read results, and insert(), update(), replace() and delete() write rows with formats.
global $wpdb;
$sql = $wpdb->prepare( "SELECT %i FROM %i WHERE post_title = %s AND ID > %d", 'post_title', $wpdb->posts, "O'Reilly", 0 );
$wpdb->insert( $wpdb->posts, array( 'post_title' => "O'Reilly", 'post_status' => 'publish', 'post_type' => 'post', 'post_content' => '', 'post_excerpt' => '', 'to_ping' => '', 'pinged' => '', 'post_content_filtered' => '' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$id = $wpdb->insert_id;
$wpdb->update( $wpdb->posts, array( 'post_title' => 'Renamed' ), array( 'ID' => $id ) );
return array( str_replace( $wpdb->posts, '<posts>', $sql ), $wpdb->get_var( $wpdb->prepare( "SELECT post_title FROM $wpdb->posts WHERE ID = %d", $id ) ), $wpdb->delete( $wpdb->posts, array( 'ID' => $id ) ), $wpdb->esc_like( '50%_off' ) );
