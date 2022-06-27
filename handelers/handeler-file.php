<?php
include "../core/functions.php";
include "../core/validation.php";
include "../confg/confg.php";
include "../confg/read.php";
include "../confg/create.php";
session_start();

if (checkRequest("add", "POST")) {
    $pation_code = postData('pation_code');
    $imgtype = postData('imgtype');
    $name = postData('name');
    $dateImg = postData('date');
    $pation_id = postData('id');
    $patterString = "/^[a-zA-Z]{3,15}+$/";
    $patternCode = "/^[0-9]{5}$/";
    $imgName = [];
    $imageFileType = [];
    $tmpName = [];
    $sizeImg = [];
    $ext = ['jpg', 'png', 'jpeg'];
    $size = 5000000;
    if (!notRequired($pation_code)) {
        $messageError['pation_code'] = "Code  Is Required";
    } elseif (!preg_match($patternCode, $pation_code)) {
        $messageError['pation_code'] = "Code Must Be 5 Number";
    }
    if (!notRequired($imgtype) || $imgtype == 'Choose...') {
        $messageError['imgtype'] = "Files add Is Required";
    }
    if (!notRequired($name)) {
        $messageError['imgName'] = "Name Img Is Required";
    } elseif (!preg_match($patterString, $name)) {
        $messageError['imgName'] = "Must Be String And Don't Have Speacial Char like example";
    }
    if (!notRequired($dateImg)) {
        $messageError['dateImg'] = "Date Is Required";
    }
    // print_r($_FILES['attachment']);die;
    if (empty($messageError)) {
        if ($_FILES['attachment']) {

            // print_r($_FILES);die;
            // Check No error
            foreach ($_FILES['attachment']['error'] as $error) {
                if ($error > 0) {
                    $messageError['img'] = "Image Is Required";
                    $_SESSION['error'] = $messageError;
                    page("../pages/pation-file.php");
                    die;
                }
            }

            if (empty($messageError['img'])) {
                foreach ($_FILES['attachment']['name'] as $photoName) {
                    $imgName[] = pathinfo($photoName, PATHINFO_FILENAME);
                    $imageFileType[] = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
                }
                foreach ($_FILES['attachment']['tmp_name'] as $tmp_name) {
                    $tmpName[] = getimagesize($tmp_name);
                }
                foreach ($_FILES['attachment']['size'] as $sizes) {
                    $sizeImg[] = $sizes;
                }

                // print_r($tmpName);
                // die;
                // Check if image file is a actual image or fake image
                for ($i = 0; $i < count($tmpName); $i++) {
                    if ($tmpName[$i] == false) {
                        $messageError['typeFile'] = "File Number " . ++$i . " is not an image.";
                        $_SESSION['error'] = $messageError;
                        page("../pages/pation-file.php");
                        die;
                    }
                }
                // Check exitentions File 
                foreach ($imageFileType  as $value) {
                    if (!in_array($value, $ext)) {
                        $messageError['extention'] = "Sorry, only  " . implode(" ", $ext) . "files are allowed.";
                        $_SESSION['error'] = $messageError;
                        page("../pages/pation-file.php");
                        die;
                    }
                }
                // Check Size Image 
                for ($i = 0; $i < count($sizeImg); $i++) {
                    if ($sizeImg[$i] > $size) {
                        $messageError['error-size'] = "Sorry Size Image Number " . ++$i . " Bigger Than 5 Mega";
                        $_SESSION['error'] = $messageError;
                        page("../pages/pation-file.php");
                        die;
                    }
                }
                // if everything is ok, try to upload file
                $target_dir_xray = "../assets/img/x-ray/";
                $target_dir_analyses = "../assets/img/analyses/";
                // Change Name image To id unique
                for ($i = 0; $i < count($imgName); $i++) {
                    $imgName[$i] = uniqid();
                }
                if ($imgtype == 'xRay') {
                    for ($i = 0; $i < count($tmpName); $i++) {
                        if (move_uploaded_file($_FILES['attachment']['tmp_name'][$i], $target_dir_xray . $imgName[$i] . '.'  . $imageFileType[$i])) {
                            $insertIntoDb = mysqli_query($confg, insertxRay($name, $dateImg, $imgName[$i] . '.' . $imageFileType[$i], $pation_id));
                            $messageSucc['succ_Img'] = "Image Is Succesfully";
                            $_SESSION['succ'] = $messageSucc;
                            page("../pages/pation-file.php");
                        } else {
                            $messageError['error-upload'] = "Sorry, there was an error uploading your file.";
                            $_SESSION['error'] = $messageError;
                            page("../pages/pation-file.php");
                            die;
                        }
                    }
                } elseif ($imgtype == 'Analyses') {
                    for ($i = 0; $i < count($tmpName); $i++) {
                        if (move_uploaded_file($_FILES['attachment']['tmp_name'][$i], $target_dir_analyses . $imgName[$i] . '.'  . $imageFileType[$i])) {
                            $insertAna = mysqli_query($confg, insertAnalyses($name, $dateImg, $imgName[$i] . '.' . $imageFileType[$i], $pation_id));
                            $messageSucc['succ_Img'] = "Image Is Succesfully";
                            $_SESSION['succ'] = $messageSucc;
                            page("../pages/pation-file.php");
                        } else {
                            $messageError['error-upload'] = "Sorry, there was an error uploading your file.";
                            $_SESSION['error'] = $messageError;
                            page("../pages/pation-file.php");
                            die;
                        }
                    }
                } else {
                    $messageError['imgtype'] = "Filles add Must Be Select From List";
                }
            } else {
                $_SESSION['error'] = $messageError;
                page("../pages/pation-file.php");
                die;
            }
        } else {
            $messageError = "Image Is Required";
            $_SESSION['error'] = $messageError;
            page("../pages/pation-file.php");
            die;
        }
    } else {
        $_SESSION['error'] = $messageError;
        page("../pages/pation-file.php");
        die;
    }
}
