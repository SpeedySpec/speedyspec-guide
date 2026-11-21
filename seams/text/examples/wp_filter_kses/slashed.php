<?php
// wp_kses_data() for slashed input, as filters on form data get it.
return wp_filter_kses( addslashes( '<b class="x">a</b><div>b</div>' ) );
