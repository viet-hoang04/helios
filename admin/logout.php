<?php
session_start();
session_unset();
header("Location: index.php", true, 302);
exit();
