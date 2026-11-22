<?php
// Emails the old admin address that the site's admin email changed, unless send_site_admin_email_change_email says no; the email is filtered by site_admin_email_change_email.
wp_site_admin_email_change_notification( 'old@example.org', 'new@example.org', 'admin_email' );
return 'done';
