<?php
// Creates a link from the Add New Link form; gives its ID.
update_option( 'link_manager_enabled', 1 );
$_POST = array( 'link_url' => 'https://example.org/', 'link_name' => 'Example' );
return get_bookmark( add_link() )->link_name;
