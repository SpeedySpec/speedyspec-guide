<?php
// Loads a plugin file to check it doesn't break the site, before activating it.
plugin_sandbox_scrape( 'hello.php' );
return function_exists( 'hello_dolly' );
