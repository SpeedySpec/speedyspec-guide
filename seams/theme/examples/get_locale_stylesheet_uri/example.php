<?php
// The URL of the theme's stylesheet for the locale ({locale}.css, or rtl.css for RTL languages), '' when there is none; filtered by locale_stylesheet_uri.
switch_theme( 'twentytwentyfive' );
return get_locale_stylesheet_uri();
