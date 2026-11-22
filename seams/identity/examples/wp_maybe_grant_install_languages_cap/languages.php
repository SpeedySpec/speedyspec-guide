<?php
// On user_has_cap: grants install_languages to users who can install plugins or themes (or update them).
$grace = guide_user();
return array( wp_maybe_grant_install_languages_cap( array( 'install_plugins' => true ) ), wp_maybe_grant_install_languages_cap( array( 'edit_posts' => true ) ) );
