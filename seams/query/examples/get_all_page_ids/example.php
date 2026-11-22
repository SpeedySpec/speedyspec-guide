<?php
// Every page's ID, cached.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
return get_all_page_ids() === array( (string) $a );
