<?php
// The newest WordPress default theme that is installed (by WP_DEFAULT_THEME, then the newest TwentyX), or false.
$theme = WP_Theme::get_core_default_theme();
return $theme ? $theme->get_stylesheet() : false;
