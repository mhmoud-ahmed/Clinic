<?php
if (checkSessionEmpty("info")) {
    page("../pages/login.php");
    die;
}
