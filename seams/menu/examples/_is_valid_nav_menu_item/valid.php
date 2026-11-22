<?php
// Whether an item isn't marked _invalid, such as one whose page was deleted; wp_get_nav_menu_items() drops invalid items outside the admin.
return array( _is_valid_nav_menu_item( (object) array() ), _is_valid_nav_menu_item( (object) array( '_invalid' => true ) ) );
