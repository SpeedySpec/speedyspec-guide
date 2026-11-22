<?php
// The column headers of a screen's list table, from manage_{$screen_id}_columns.
_get_list_table( 'WP_Posts_List_Table', array( 'screen' => 'edit-post' ) );
return array_keys( get_column_headers( 'edit-post' ) );
