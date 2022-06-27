<?php
if (checkSession("info")) {
    page("../pages/home.php");
    die;
}
