<?php
// With no setting exposed, core/settings-get isn't registered.
guide_core_abilities();
return wp_has_ability( 'core/settings-get' );
