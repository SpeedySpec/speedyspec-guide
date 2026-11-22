<?php
// Whether the current user may see the admin page being shown, by the capability its menu entry needs.
$GLOBALS['pagenow'] = 'options-general.php';
guide_admin_menu();
return user_can_access_admin_page();
