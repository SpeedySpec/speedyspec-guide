<?php
// Creates a multisite network: its row, its main site and its network options; gives true or an error.
global $wpdb;
return populate_network( 1, 'example.org', 'admin@example.org', 'Guide Network', '/', false )->get_error_code();
