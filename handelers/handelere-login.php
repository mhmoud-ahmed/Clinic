<?php
include "../core/functions.php";
include "../core/validation.php";
include "../confg/read.php";
session_start();
if ($_POST) {
    // make fliter data
    // storeg data in variable
    $username = fliterEmail(postData('username'));
    $password = filterInputs(postData('password'));
    $patternUsername = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    $patternPassword = "/^.{4,15}$/";
    // make validation
    #username Validation
    if (!notRequired($username)) {
        $messageError['username'] = "Username Is Required";
    } elseif (!preg_match($patternUsername, $username)) {
        $messageError['username'] = "Simple email expression. Doesn't allow numbers in the domain name and doesn't allow for top level domains that are less than 2 or more than 3 letters (which is fine until they allow more). Doesn't handle multiple &quot;.&quot; in the domain (joe@abc.co.uk).";
    }
    #password Validation
    if (!notRequired($password)) {
        $messageError['password'] = "Password Is Required";
    } elseif (!preg_match($patternPassword, $password)) {
        $messageError['password'] = "	
        Matches any string between 4 and 15 characters in length. Limits the length of a string. Useful to add to password regular expressions.";
    }

    #Check ErrorMessage
    if (!empty($messageError)) {
        //Store Error In Session
        $_SESSION['errorValidation'] = $messageError;
        // Return To page name
        page("../pages/login.php");
        die;
    } else {
        // check username is exist
        if (checkloginResption($username)->num_rows == 0 && checkloginDoctor($username)->num_rows == 0) {
            $messageError['errorExists'] = "Your Username OR Password Not Correctss";
            $_SESSION['errorExists'] = $messageError;
            page("../pages/login.php");
            die;
        } else {
            $data = [];
            if (checkloginResption($username)->num_rows > 0) {
                while ($row = mysqli_fetch_assoc(checkloginResption($username))) {
                    // Check If User and Password Is corect 
                    if ($row['username'] == $username && $row['password'] == $password) {
                        $data = $row;
                        $_SESSION['info'] = $data;
                        page("../pages/home.php?id={$data['id']}");
                        die;
                    } else {
                        $messageError['errorlogin'] = "Your Username OR Password Not Correct";
                        $_SESSION['errorlogin'] = $messageError;
                        page("../pages/login.php");
                        die;
                    }
                }
            } elseif (checkloginDoctor($username)->num_rows > 0) {
                while ($row = mysqli_fetch_assoc(checkloginDoctor($username))) {
                    // Check If User and Password Is corect 
                    if ($row['email'] == $username && $row['password'] == $password) {
                        $data = $row;
                        print_r($data);
                        die;
                        $_SESSION['info'] = $data;
                        page("../pages/home.php?id={$data['id']}");
                        die;
                    } else {
                        $messageError['errorlogin'] = "Your Username OR Password Not Correct";
                        $_SESSION['errorlogin'] = $messageError;
                        page("../pages/login.php");
                        die;
                    }
                }
            }
        }
    }
}
