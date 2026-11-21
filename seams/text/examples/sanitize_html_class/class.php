<?php
// Letters, digits, dashes and underscores only; an empty result falls back.
return array( sanitize_html_class( 'my class!' ), sanitize_html_class( '!!!', 'none' ) );
