<?php
include "../core/functions.php";
session_start();
session_destroy();
page("../pages/login.php");
die;
