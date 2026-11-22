<?php
// The search form: the theme's searchform.php, else WordPress's HTML5 form; printed unless echo is false; filtered by search_form_format and get_search_form.
return get_search_form( array( 'echo' => false, 'aria_label' => 'Site search' ) );
