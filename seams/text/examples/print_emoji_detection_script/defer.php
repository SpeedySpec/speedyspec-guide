<?php
// Once a request: before the footer scripts run, it hooks the script to wp_print_footer_scripts.
print_emoji_detection_script();
print_emoji_detection_script();
return has_action( 'wp_print_footer_scripts', '_print_emoji_detection_script' );
