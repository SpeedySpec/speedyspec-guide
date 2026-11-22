<?php
// Removes every tag from slashed input.
return wp_filter_nohtml_kses( addslashes( '<b>a</b> & <i>b</i>' ) );
