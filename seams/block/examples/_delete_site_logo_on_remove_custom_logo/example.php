<?php
// Deletes the site_logo option when the custom_logo theme mod is removed from the theme mods.
update_option( 'site_logo', 42 );
_delete_site_logo_on_remove_custom_logo( array( 'custom_logo' => 42 ), array() );
return get_option( 'site_logo' );
