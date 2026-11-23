<?php
// Prints the link edit screen's Link Relationship (XFN) box, with the relationship choices.
return str_contains( guide_render( fn() => link_xfn_meta_box( (object) array( 'link_rel' => 'friend met' ) ) ), 'friendship' );
