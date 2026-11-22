<?php
// Keeps only the CSS properties allowed in a style attribute, and values without url() for properties that can't take one.
return safecss_filter_attr( 'color: red; behavior: url(x.htc); background-image: url(javascript:x); margin: 0' );
