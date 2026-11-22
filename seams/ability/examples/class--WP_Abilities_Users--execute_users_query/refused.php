<?php
// Filters that can't be honoured are refused rather than dropped, so the query never widens.
guide_core_abilities();
$users = new WP_Abilities_Users();
$calls = array(
	array( 'where' => 'x' ),
	array( 'where' => array( 'ids' => array( 0, -1 ) ) ),
	array( 'where' => array( 'roles' => array( 'administrator' ) ) ),
	array( 'where' => array( 'usernames' => array( 'admin' ) ) ),
	array( 'where' => array( 'has_published_posts' => false ) ),
);
return array_map( fn( $input ) => guide_private( $users, 'execute_users_query', $input )->get_error_message(), $calls );
