<?php
// A select of users: by default every user, by display name, with options to show a different field, include an empty option, and mark the selected one; wp_dropdown_users filters the markup.
$grace = guide_user();
return wp_dropdown_users( array( 'echo' => false, 'selected' => $grace, 'show_option_none' => 'None' ) );
