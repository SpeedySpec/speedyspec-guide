<?php
// Hooked to the new site email being saved: emails the new address a link to confirm it, and keeps it pending until then.
$sent = array();
update_option_new_admin_email( 'admin@example.org', 'new@example.org' );
return get_option( 'adminhash' )['newemail'];
