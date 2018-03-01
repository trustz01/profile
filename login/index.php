<?php
session_start();
session_unset();
echo "<script>window.location.assign('../home/index.html')</script>";
session_destroy();
session_write_close();
?> 