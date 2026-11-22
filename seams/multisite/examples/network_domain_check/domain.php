<?php
// The domain of an existing network, when the network tables already hold one; false otherwise.
require_once ABSPATH . 'wp-admin/includes/network.php';
return network_domain_check();
