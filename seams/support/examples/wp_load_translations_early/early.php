<?php
// Loads the translation functions and the site's language files before WordPress is set up, for messages like the database error page.
wp_load_translations_early();
return function_exists( '__' );
