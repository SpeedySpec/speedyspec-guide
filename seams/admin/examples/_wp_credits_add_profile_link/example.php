<?php
// Turns a contributor's name into a link to their WordPress.org profile, for the credits.
$name = 'Ada Lovelace';
_wp_credits_add_profile_link( $name, 'ada', 'https://profiles.wordpress.org/%s/' );
return $name;
