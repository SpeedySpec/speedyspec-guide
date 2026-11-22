<?php
// Asks the new network admin address to confirm itself by email before it changes, storing the request in network_admin_hash; on update_site_option_new_admin_email.
update_network_option_new_admin_email( 'admin@example.org', 'newadmin@example.org' );
return get_site_option( 'network_admin_hash' )['newemail'];
