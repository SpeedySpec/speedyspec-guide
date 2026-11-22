<?php
// Adds a file to the top of the five most recently edited files in the file editor.
update_recently_edited( 'style.css' );
update_recently_edited( 'functions.php' );
return get_option( 'recently_edited' );
