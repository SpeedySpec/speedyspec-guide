<?php
// Prints the scripts queued for the footer; gives the handles printed.
wp_enqueue_script( 'guide-foot', 'https://cdn.example/foot.js', array(), null, true );
ob_start();
print_head_scripts();
ob_end_clean();
ob_start();
$done = print_footer_scripts();
ob_end_clean();
return in_array( 'guide-foot', $done, true );
