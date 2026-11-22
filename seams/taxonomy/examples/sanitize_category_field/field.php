<?php
// Cleans one category field for a context, as sanitize_term_field() does.
return array( sanitize_category_field( 'name', '<b>Hi</b> & you', 1, 'display' ), sanitize_category_field( 'slug', 'Hello World', 1, 'db' ) );
