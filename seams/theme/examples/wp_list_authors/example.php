<?php
// Prints (or gives) a list of authors with posts, linked to their archives, with counts, feeds and full names, as a list or plain.
wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
return wp_list_authors( array( 'echo' => false, 'optioncount' => true ) );
