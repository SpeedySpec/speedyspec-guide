<?php
// The URL of an admin stylesheet, with its version; filtered by wp_admin_css_uri.
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', wp_admin_css_uri( 'css/login' ) );
