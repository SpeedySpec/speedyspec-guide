<?php
// Ajax handler that deletes a page from a list with wp_delete_post(), which moves it to the Trash unless the Trash is off; answers 1 on success.
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
return array( guide_ajax( fn() => wp_ajax_delete_page( 'delete-page' ), array( 'id' => $page ), "delete-page_$page" ), get_post_status( $page ) );
