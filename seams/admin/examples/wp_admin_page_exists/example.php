<?php
// Whether the admin page being requested is registered, so admin.php can give a 404-style error for unknown pages.
$GLOBALS['pagenow'] = 'index.php';
$GLOBALS['plugin_page'] = null;
return wp_admin_page_exists();
