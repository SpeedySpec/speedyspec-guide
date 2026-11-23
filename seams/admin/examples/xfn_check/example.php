<?php
// Prints checked="checked" when a link's XFN relationships include a value.
$GLOBALS['link'] = (object) array( 'link_rel' => 'friend met' );
return array( guide_render( fn() => xfn_check( 'friendship', 'friend' ) ), guide_render( fn() => xfn_check( 'friendship', 'contact' ) ) );
