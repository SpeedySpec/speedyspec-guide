<?php
// Registers the column headers of a screen's list table.
register_column_headers( 'guide-teas', array( 'name' => 'Name', 'origin' => 'Origin' ) );
return get_column_headers( 'guide-teas' );
