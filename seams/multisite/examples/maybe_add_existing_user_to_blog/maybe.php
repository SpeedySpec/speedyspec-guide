<?php
// Adds a user to a site when they follow its invitation link (/newbloguser/<key>/); nothing on other requests.
$_SERVER['REQUEST_URI'] = '/hello/';
maybe_add_existing_user_to_blog();
return 'not an invitation';
