<?php
// Adds the async or defer attribute a script asks for to its tag, once; legacy async and defer data become the strategy.
guide_theme( 'twentytwenty' );
wp_register_script( 'guide-x', 'x.js' );
wp_script_add_data( 'guide-x', 'strategy', 'defer' );
$loader = new TwentyTwenty_Script_Loader();
return $loader->filter_script_loader_tag( '<script src="x.js"></script>', 'guide-x' );
