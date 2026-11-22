<?php
// The archive's title with its kind as a prefix (Category:, Tag:, Author:, Year: and so on); filtered by get_the_archive_title_prefix and get_the_archive_title.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( '/?cat=1' );
$cat = get_the_archive_title();
guide_go( '/?author=1' );
$author = get_the_archive_title();
guide_go( '/?m=2026' );
return array( $cat, $author, get_the_archive_title() );
