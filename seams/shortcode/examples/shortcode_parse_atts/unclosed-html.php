<?php
// A value holding an unclosed HTML element becomes empty.
return shortcode_parse_atts( 'a="<b>ok</b>" b="<img src=x"' );
