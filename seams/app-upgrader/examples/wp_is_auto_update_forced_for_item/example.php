<?php
// Whether auto_update_{type} forces automatic updates on or off for a plugin or theme, whatever the user chose.
function guide_never_update_hello( $update, $item )
{
	return 'hello-dolly' === ( $item->slug ?? '' ) ? false : $update;
}
add_filter( 'auto_update_plugin', 'guide_never_update_hello', 10, 2 );
return array( wp_is_auto_update_forced_for_item( 'plugin', null, (object) array( 'slug' => 'hello-dolly' ) ), wp_is_auto_update_forced_for_item( 'plugin', null, (object) array( 'slug' => 'akismet' ) ) );
