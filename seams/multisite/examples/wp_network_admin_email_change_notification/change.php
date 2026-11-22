<?php
// Emails the old network admin address that the address changed, unless send_network_admin_email_change_email says no.
return wp_network_admin_email_change_notification( 'admin_email', 'new@example.org', 'admin@example.org', 1 );
