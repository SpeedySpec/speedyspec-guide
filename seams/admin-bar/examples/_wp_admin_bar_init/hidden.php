<?php
// When the admin bar isn't showing, nothing is created.
return array( _wp_admin_bar_init(), isset( $GLOBALS['wp_admin_bar'] ) );
