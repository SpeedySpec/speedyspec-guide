<?php
// The archive title: Category, Tag, Author, Yearly, Monthly, Daily, Post Type or taxonomy Archives, the name in a page-description span; on get_the_archive_title.
guide_theme( 'twentynineteen' );
$cat = wp_insert_term( 'News', 'category' );
$GLOBALS['wp_query'] = new WP_Query( array( 'cat' => $cat['term_id'] ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
return twentynineteen_get_the_archive_title();
