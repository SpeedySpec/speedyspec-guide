<?php
// An icon's SVG in an ab-icon span; an unknown icon gives ''.
$icon = _wp_admin_bar_icon( 'core-admin/search' );
return array( str_starts_with( $icon, '<span class="ab-icon svg-icon" aria-hidden="true"><svg' ), _wp_admin_bar_icon( 'nope/none' ) );
