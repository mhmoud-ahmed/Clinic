<?php
include "../core/functions.php";
include "../core/validation.php";
include "../confg/confg.php";
include "../confg/read.php";
include "../confg/create.php";

session_start();
if (checkRequest("add-pation", "POST")) {
    // filter all input 
    foreach ($_POST as $key => $value) {
        $_POST[$key] =  filterInputs($value);
    }
    // stored data in var
    $fName = postData('fName');
    $lName = postData('lName');
    $phone = postData('phone');
    $age = postData('age');
    $covernorate = postData('covernorate');
    $city = postData('city');
    $gender = postData('gender');
    $status = postData('status');
    $date = postData('date');
    $patterString = "/^[a-zA-Z]{3,15}+$/";
    $pattergender = "/^[a-zA-Z]{1,4}+$/";
    $patterPhone = "/^01[0125][0-9]{8}$/";
    $patterage = '/^[1-9][0-9]?$|^100$/';
    $messageError = [];
    $messageSuccess = [];
    // check data not empty
    // match data equal regulaer experationh
    #Name Validation
    if (!notRequired($fName)) {
        $messageError['fname'] = "FirstName Is Required";
    } elseif (!preg_match($patterString, $fName)) {
        $messageError['fname'] = "Must Be String And Don't Have Speacial Char like example";
    }
    if (!notRequired($lName)) {
        $messageError['lname'] = "LastName Is Required";
    } elseif (!pregInput($patterString, $lName)) {
        $messageError['lname'] = "LastName Must Be String And Don't Have Speacial Char like example";
    }
    #Phone Validation
    if (!notRequired($phone)) {
        $messageError['phone'] = "Phone Is Required";
    } elseif (!pregInput($patterPhone, $phone)) {
        $messageError['phone'] = "Phone length is exactly 11 And  allowed ones 010, 011, 012, 015";
    }
    #Birthdate Validation
    if (!notRequired($age)) {
        $messageError['birthdate'] = "Age Is Required";
    } elseif (!pregInput($patterage, $age)) {
        $messageError['birthdate'] = "Age Must Between 1 To 100";
    }
    #Address Validation
    if (!notRequired($covernorate)) {
        $messageError['covernorate'] = "Covernorate Is Required";
    } elseif (!pregInput($patterString, $covernorate)) {
        $messageError['covernorate'] = "Covernorate Must Be String And Don't Have Speacial Char like example";
    }
    if (!notRequired($city)) {
        $messageError['city'] = "City Is Required";
    } elseif (!pregInput($patterString, $city)) {
        $messageError['city'] = "city Must Be String And Don't Have Speacial Char like example";
    }
    #Status Validation
    if (!notRequired($gender)) {
        $messageError['gender'] = "gender Is Required";
    } elseif (!pregInput($pattergender, $gender)) {
        $messageError['gender'] = "Gender Must Be Select From List";
    }
    #Gender Validation
    if (!notRequired($status)) {
        $messageError['status'] = "status Is Required";
    } elseif (!pregInput($patterString, $status)) {
        $messageError['status'] = "status Must Be Select From List";
    }
    if (!notRequired($date)) {
        $messageError['date'] = "Date Is Required";
    }

    $clinic_id = catchDataSession('info', 'clinic_id');
    // Check Error Message Not Empty
    if (!empty($messageError)) {
        // Storeg Error In Session And Return To page
        $_SESSION['errorValidation'] = $messageError;
        page("../pages/home.php");
        die;
    } else {
        // check pation 
        $data = [];
        $pations = mysqli_query($confg, checkPation($phone));
        if ($pations->num_rows > 0) {
            while ($row = $pations->fetch_assoc()) {
                $data = $row;
            }
            #Data Reservation
            $timestamp = strtotime($date);
            $pation_id = $data['id'];
            $type_reservation = postData('status');
            $day_reservation = date('l', $timestamp);
            $schadules = [];
            $allSchadules = [];
            // Day ---- Here problem
            $clinicSchadule = mysqli_query($confg, clinicSchadule($clinic_id));
            if ($clinicSchadule->num_rows > 0) {
                while ($row = $clinicSchadule->fetch_assoc()) {
                    $schadules[] = $row['day'];
                }
            }
            // Check Day reservation == clinic schadule
            if (in_array($day_reservation, $schadules)) {
                // Check Pation reservation Or not
                $checkReservation = mysqli_query($confg, checkReservation($date, $pation_id));
                // print_r($checkReservation);die;
                if ($checkReservation->num_rows == 0) {
                    // print_r($date);die;
                    $addReservationPation = mysqli_query($confg, addReservation($pation_id, $clinic_id, $type_reservation, $date));
                    $messageSuccess['successApoiment'] = "Appioment Is Successfuly In $day_reservation,  $date";
                    $_SESSION['successApoiment'] = $messageSuccess;
                    page("../pages/home.php");
                    die;
                } elseif ($checkReservation->num_rows > 0) {
                    $messageError['errorReservation'] = "You All Read Appoiment In This Day";
                    $_SESSION['errorReservation'] = $messageError;
                    page("../pages/home.php");
                    die;
                }
            } else {
                $messageError['clinic'] = "Sry This Appoiment For " . catchDataSession('info', 'clinic_name');
                $_SESSION['clinic'] = $messageError;
                page("../pages/home.php");
                die;
            }
        } elseif ($pations->num_rows == 0) {
            $insertAdd = mysqli_query($confg, insertAddres($covernorate, $city));
            if ($insertAdd) {

                #Add Address Pation
                $address_id = $confg->insert_id;
                #Add Pation Info
                $birthday = date("Y")  - $age . "-01" . "-01";
                $insertPation = mysqli_query($confg, insertPation($fName, $lName, $phone, rand(10000, 99999), $birthday, $gender, $address_id));
                if ($insertPation) {
                    // Make Reserbation
                    $pation_id = $confg->insert_id;

                    $insertReserbation = mysqli_query($confg, addReservation($pation_id, $clinic_id, $status, $date));
                    if ($insertReserbation) {
                        $messageSuccess['successApoiment'] = "Appioment Is Successfuly In $day_reservation,  $date";
                        $_SESSION['successApoiment'] = $messageSuccess;
                        page("../pages/home.php");
                        die;
                    } else {
                        $messageError['errorReservation'] = "Sorry We Have A problem in Server Please Try another time";
                        $_SESSION['errorReservation'] = $messageError;
                        page("../pages/home.php");
                        die;
                    }
                }
            }
        }
        // pation is exist

    }
} elseif (checkRequestGET("pation_id", "GET") && getData('status')) {
    $pation_id = getData('pation_id');
    $status = getData('status');
    $clinic_id = catchDataSession("info", 'clinic_id');
    $date = date("Y-m-d");
    $timestamp = strtotime($date);
    $day_reservation = date('l', $timestamp);
    $schadules = [];
    $allSchadules = [];
    // Day ---- Here problem
    $clinicSchadule = mysqli_query($confg, clinicSchadule($clinic_id));
    if ($clinicSchadule->num_rows > 0) {
        while ($row = $clinicSchadule->fetch_assoc()) {
            $schadules[] = $row['day'];
        }
    }
    // Check Day reservation == clinic schadule
    if (in_array($day_reservation, $schadules)) {
        // Check Pation reservation Or not
        $checkReservation = mysqli_query($confg, checkReservation($date, $pation_id));
        // print_r($checkReservation);die;
        if ($checkReservation->num_rows == 0) {
            // print_r($date);die;
            $addReservationPation = mysqli_query($confg, addReservation($pation_id, $clinic_id, $status, $date));
            $messageSuccess['successApoiment'] = "Appioment Is Successfuly In $day_reservation,  $date";
            $_SESSION['successApoiment'] = $messageSuccess;
            page("../pages/home.php");
            die;
        } elseif ($checkReservation->num_rows > 0) {
            $messageError['errorReservation'] = "You All Read Appoiment In This Day";
            $_SESSION['errorReservation'] = $messageError;
            page("../pages/home.php");
            die;
        }
    } else {
        $messageError['clinic'] = "Sry This Appoiment For " . catchDataSession('info', 'clinic_name') . " Clinic";
        $_SESSION['clinic'] = $messageError;
        page("../pages/home.php");
        die;
    }
}
