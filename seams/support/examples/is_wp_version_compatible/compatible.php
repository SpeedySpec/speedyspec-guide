<?php
// Whether WordPress is at least a version; an empty requirement is met.
return array( is_wp_version_compatible( '5.0' ), is_wp_version_compatible( '99.0' ), is_wp_version_compatible( '' ) );
