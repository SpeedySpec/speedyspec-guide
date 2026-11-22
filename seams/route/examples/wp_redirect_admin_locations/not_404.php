<?php
// Only on a 404 with pretty permalinks: then /wp-admin, /dashboard and /admin go to the admin, /login to the login page, and /.well-known/change-password to the profile (wp_change_password_url). Otherwise nothing happens.
wp_redirect_admin_locations();
return 'no redirect';
