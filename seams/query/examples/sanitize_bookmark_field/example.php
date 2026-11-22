<?php
// Sanitizes one link field for a context: raw, edit, db, display or attribute; IDs and ratings are cast to integers, targets must be _top or _blank, visibility keeps only Y or N, and the field's filters run for the context.
return array( sanitize_bookmark_field( 'link_rating', 42, 1, 'db' ), sanitize_bookmark_field( 'link_target', '_evil', 1, 'db' ), sanitize_bookmark_field( 'link_name', 'A & B', 1, 'display' ) );
