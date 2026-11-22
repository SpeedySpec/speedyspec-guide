<?php
// Prints a script that adds is-IE to the body in Internet Explorer.
guide_theme( 'twentytwentyone' );
return str_contains( guide_render( 'twentytwentyone_add_ie_class' ), "document.body.classList.add('is-IE')" );
