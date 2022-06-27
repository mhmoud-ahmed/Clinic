<?php
include "../core/functions.php";
include "../core/validation.php";
include "../confg/confg.php";
include "../confg/read.php";
include "../confg/create.php";
session_start();
if (checkRequest("search", "POST")) {
    $phone = filterInputs(postData('query'));
    $info = [];
    $pation = mysqli_query($confg, pation_info($phone));
    if ($pation->num_rows > 0) {
        while ($row = $pation->fetch_assoc()) {
            $info = $row;
        }
        $_SESSION['pation_info'] = $info;
        page("../pages/file-pation.php");
        die;
    } else {
        $messageError['error_pation-info'] = " Pation Is Not Existe And please make Reservation And File";
        $_SESSION['error_pation-info'] = $messageError;
        
        page("../pages/home.php");
        die;
    }
}
