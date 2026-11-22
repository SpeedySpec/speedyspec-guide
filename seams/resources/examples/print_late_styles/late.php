<?php
// Prints the styles queued after the head was printed (in the footer), unless print_late_styles says no; gives the handles printed.
wp_styles()->do_concat = false;
ob_start();
print_admin_styles();
ob_end_clean();
wp_enqueue_style( 'guide-late', 'https://cdn.example/late.css', array(), null );
ob_start();
$done = print_late_styles();
ob_end_clean();
return $done;
