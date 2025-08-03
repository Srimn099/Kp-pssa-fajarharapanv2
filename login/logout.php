<?php
unset($_SESSION['username']);
unset($_SESSION['nama']);
session_destroy();
header("Location:../index.php");
