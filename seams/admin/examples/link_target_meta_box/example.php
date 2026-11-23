<?php
// Prints the link edit screen's Target box: _blank, _top or none.
return str_contains( guide_render( fn() => link_target_meta_box( (object) array( 'link_target' => '_blank' ) ) ), "value=\"_blank\" checked=\"checked\"" );
