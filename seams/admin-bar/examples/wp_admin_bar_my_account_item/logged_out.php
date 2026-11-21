<?php
// Nobody logged in: nothing is added.
$bar = new WP_Admin_Bar();
wp_admin_bar_my_account_item( $bar );
return guide_nodes( $bar );
