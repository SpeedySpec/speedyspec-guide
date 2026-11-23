<?php
// Hooked to admin_menu for block themes: adds the Plugin File Editor under Tools, since Appearance has no editor link.
switch_theme( 'twentytwentyfive' );
guide_admin_menu();
_add_plugin_file_editor_to_tools();
return in_array( 'plugin-editor.php', wp_list_pluck( $GLOBALS['submenu']['tools.php'], 2 ), true );
