<?php
// init() sets the translated names, the number format, the text direction (from the text_direction string or the global) and the list separator and word count type.
$l = $GLOBALS['wp_locale'];
return array( $l->number_format, $l->text_direction, $l->is_rtl(), $l->get_list_item_separator(), $l->get_word_count_type(), count( $l->month ), $GLOBALS['text_direction'] ?? null );
