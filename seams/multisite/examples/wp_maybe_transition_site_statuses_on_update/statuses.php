<?php
// Fires the status actions when a site's flags change: make_spam_blog or make_ham_blog, archive_blog or unarchive_blog, make_delete_blog or make_undelete_blog, mature_blog or unmature_blog, and update_blog_public.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
add_action( 'archive_blog', fn( $id ) => print( "archive_blog $id\n" ) );
add_action( 'make_spam_blog', fn( $id ) => print( "make_spam_blog $id\n" ) );
wp_update_site( $site, array( 'archived' => 1, 'spam' => 1 ) );
return 'done';
