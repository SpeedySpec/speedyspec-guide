<?php
// Whether a field is among the requested fields, counting parents and children of dotted fields.
$fields = array( 'id', 'title.rendered', 'meta' );
return array( rest_is_field_included( 'title', $fields ), rest_is_field_included( 'meta.color', $fields ), rest_is_field_included( 'content', $fields ) );
