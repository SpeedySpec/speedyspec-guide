<?php
// Sanitizes one post field for a context: raw, edit, db, display, attribute or js; IDs and counts are integers, and the field's filters run for the context.
return array( sanitize_post_field( 'post_title', 'A & B', 1, 'display' ), sanitize_post_field( 'post_title', '"x"', 1, 'attribute' ), sanitize_post_field( 'menu_order', '3x', 1, 'db' ) );
