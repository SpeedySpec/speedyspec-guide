<?php
// Splits a whole tag into its opening, each attribute, and its end.
return wp_kses_attr_parse( '<img src="a" alt="b" />' );
