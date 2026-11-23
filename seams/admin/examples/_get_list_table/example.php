<?php
// Makes an admin list table by class name, loading its file, for a screen; gives it or false.
$table = _get_list_table( 'WP_Posts_List_Table', array( 'screen' => 'edit-post' ) );
return array( get_class( $table ), $table->screen->id );
