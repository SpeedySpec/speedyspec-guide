<?php
// Whether the main query is for a custom taxonomy archive, optionally of a taxonomy and terms; categories and tags don't count.
register_taxonomy( 'genre', 'post', array( 'public' => true, 'query_var' => true ) );
wp_insert_term( 'Jazz', 'genre' );
guide_go( '/?genre=jazz' );
$jazz = array( is_tax(), is_tax( 'genre', 'jazz' ) );
guide_go( '/?cat=1' );
return array( $jazz, is_tax() );
