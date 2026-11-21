<?php
// Filters one attribute, as name="value", for an element.
return array( wp_kses_one_attr( 'href="javascript:alert(1)"', 'a' ), wp_kses_one_attr( 'title="ok"', 'a' ) );
