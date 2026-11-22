<?php
// Adds the font CSS for the site's language to the theme style, for languages that need other fonts; on wp_enqueue_scripts.
guide_theme( 'twentytwentyone' );
twenty_twenty_one_scripts();
add_filter( 'locale', fn() => 'ja' );
twenty_twenty_one_non_latin_languages();
return substr( wp_styles()->get_data( 'twenty-twenty-one-style', 'after' )[0], -45 );
