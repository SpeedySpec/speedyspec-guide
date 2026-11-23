<?php
// The hook suffix of a plugin admin page from its slug and parent, such as settings_page_tea.
guide_admin_menu();
return array( get_plugin_page_hookname( 'tea', 'options-general.php' ), get_plugin_page_hookname( 'tea', '' ) );
