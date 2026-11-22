<?php
// Fires the status actions when a site's flags change: make_spam_blog or make_ham_blog, archive_blog or unarchive_blog, make_delete_blog or make_undelete_blog, mature_blog or unmature_blog, and update_blog_public.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
function guide_print_archive_blog( $id ) {
	echo "archive_blog $id\n";
}
add_action( 'archive_blog', 'guide_print_archive_blog' );
function guide_print_make_spam_blog( $id ) {
	echo "make_spam_blog $id\n";
}
add_action( 'make_spam_blog', 'guide_print_make_spam_blog' );
wp_update_site( $site, array( 'archived' => 1, 'spam' => 1 ) );
return 'done';
