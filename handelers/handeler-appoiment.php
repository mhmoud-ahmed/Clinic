<?php
include "../core/functions.php";
include "../core/validation.php";
include "../confg/confg.php";
include "../confg/read.php";
include "../confg/create.php";
include "../confg/update.php";
if (checkRequestGET("pation_id", "GET")) {
    // Change Status in Reservation TAbel 
    $reservation_id = $_GET['pation_id'];
    $message = [];
    if (!empty($reservation_id)) {
        $visit = mysqli_query($confg, visit($reservation_id));
        if ($visit) {
            $message['succ'] = "You Visit IS Done Thank You";
            $_SESSION['succ'] = $message;
            page("../pages/appoiment.php");
            die;
        } else {
            $message['error-logic'] = "Sry You Have a Problem Please Check Your Logic";
            $_SESSION['error'] = $message;
            page("../pages/appoiment.php");
            die;
        }
    }
}
