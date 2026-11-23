<?php
// On the Links screens, stops with a message that the link manager is off, pointing to the Link Manager plugin; does nothing on other screens.
$GLOBALS['pagenow'] = 'index.php';
return wp_link_manager_disabled_message();
