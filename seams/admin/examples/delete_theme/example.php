<?php
// Deletes a theme's files through $wp_filesystem, then its translation files and update data; true or an error; true when the theme isn't there.
return delete_theme( 'no-such-theme' );
