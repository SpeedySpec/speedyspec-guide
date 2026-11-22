<?php
// Prints (or gives) the hidden _wp_http_referer field holding the current address, without removable query arguments.
$_SERVER['REQUEST_URI'] = '/wp-admin/edit.php?updated=1&paged=2';
return wp_referer_field( false );
