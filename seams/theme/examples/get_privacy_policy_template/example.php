<?php
// The path of the privacy policy page's template, privacy-policy.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return get_privacy_policy_template();
