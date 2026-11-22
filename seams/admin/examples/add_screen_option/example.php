<?php
// Adds an option to the current screen's Screen Options, such as per_page or layout_columns.
set_current_screen( 'edit-post' );
add_screen_option( 'per_page', array( 'label' => 'Teas per page', 'default' => 10, 'option' => 'teas_per_page' ) );
return get_current_screen()->get_option( 'per_page', 'option' );
