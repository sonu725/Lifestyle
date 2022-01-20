<?php

session_start();
session_destroy();
header("location:index.php?lg=1");
?>