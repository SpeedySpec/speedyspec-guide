<?php
// The admin footer's version text: the version, or a link to update when one is offered; filtered by update_footer.
guide_offer_core_update( '7.3' );
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', wp_strip_all_tags( core_update_footer() ) );
