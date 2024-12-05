<?php
session_start();
session_unset();
session_destroy();
header("location: ../client/landing.php");
exit();