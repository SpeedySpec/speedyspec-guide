<?php
// A registered icon's SVG markup, sanitized and sized, or an empty string when there is no such icon.
wp_register_icon_collection( 'my-plugin', array( 'label' => 'My Plugin' ) );
wp_register_icon( 'my-plugin/dot', array( 'label' => 'Dot', 'content' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/></svg>' ) );
return array( wp_get_icon( 'my-plugin/dot' ), wp_get_icon( 'my-plugin/none' ) );
