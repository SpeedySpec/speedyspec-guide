<?php
// Restores mbstring's encoding after mbstring_binary_safe_encoding().
mbstring_binary_safe_encoding();
reset_mbstring_encoding();
return mb_internal_encoding();
