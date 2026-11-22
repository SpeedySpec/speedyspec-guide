<?php
// The top-secondary group, on the right, and wp-logo-external under the logo.
$bar = new WP_Admin_Bar();
wp_admin_bar_add_secondary_groups( $bar );
return guide_nodes( $bar );
