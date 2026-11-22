<?php
// The site's domain without www and any port, for the network setup screen.
require_once ABSPATH . 'wp-admin/includes/network.php';
return get_clean_basedomain();
