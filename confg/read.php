<?php
include "confg.php";

function checkPation($number)
{
    $sql = "SELECT * FROM `pationes` WHERE `phone` = $number";
    return $sql;
}
function reservation()
{
    global $confg;
    $sql = "SELECT * FROM `reservations_pation`";
    $result = mysqli_query($confg, $sql);
    return $result;
}
function checkloginResption($username)
{
    global $confg;
    $sql = "SELECT * FROM `clinic_info` WHERE `username` = '$username'";
    $result = mysqli_query($confg, $sql);
    return $result;
}
function checkloginDoctor($username)
{
    global $confg;
    $sql = "SELECT * FROM `doctors` WHERE `email` = '$username'";
    $result = mysqli_query($confg, $sql);
    return $result;
}
function checkReservation($date, $pation_id)
{
    $sql = "SELECT * FROM `reservations_pation` WHERE `date` = '$date' AND `pation_id` = '$pation_id'";
    return $sql;
}
function clinicSchadule($clinic_id)
{
    $sql = "SELECT `day` FROM `schadules` LEFT JOIN `clinics` ON `schadules`.`clinic_id` = `clinics`.`id` WHERE `clinic_id` = $clinic_id";
    return $sql;
}
function schadules()
{
    $sql = "SELECT
    `schadules`.`day`,
    `clinics`.`name`
FROM
    `schadules`
JOIN `clinics` ON `schadules`.`clinic_id` = `clinics`.`id`";
    return $sql;
}
function appoimentToday($date, $clinic_id)
{
    $sql = "SELECT
    `reservations_pation`.`id`,
    `reservations_pation`.`type_reservation`,
    CONCAT(`pationes`.`first_name`,' ',`pationes`.`last_name`) AS `FullName`,
    `pationes`.`age`,
    `pationes`.`phone`,
    `pationes`.`code`
FROM
    `reservations_pation`
JOIN `pationes` ON `reservations_pation`.`pation_id` = `pationes`.`id`  WHERE `date` = '$date' AND `clinic_id` = '$clinic_id' AND `status` = 0";
    return $sql;
}
function contactView($clinic_name)
{
    $sql = "SELECT * FROM `clinic_contact` WHERE `clinic_Name` = '$clinic_name'";
    return $sql;
}
function pation_info($pation_phone)
{
    $sql = "SELECT
    `pationes`.`id`,
    CONCAT(
        `pationes`.`first_name`,
        ' ',
        `pationes`.`last_name`
    ) AS `full_name`,
    `pationes`.`phone`,
    `pationes`.`code`,
    `pationes`.`age`,
    `files`.`created_at` AS `date_detection`,
    `files`.`diagnosis`,
    `files`.`medicine`,
    `medical_analyses`.`image` AS `analyses`,
    `x_rays`.`image` AS `x_rays`
FROM
    `pationes`
LEFT JOIN `files` ON `files`.`patione_id` = `pationes`.`id`
LEFT JOIN `x_rays` ON `x_rays`.`file_id` = `files`.`id`
LEFT JOIN `medical_analyses` ON `medical_analyses`.`file_id` = `files`.`id` WHERE `pationes`.`phone` = $pation_phone";
    return $sql;
}
function checkPrescription($pation_id)
{
    $sql = "SELECT
    `files`.*,
    `pationes`.*
FROM
    `files`
JOIN `pationes` ON `files`.`patione_id` = `pationes`.`id`
WHERE `pationes`.`id` = $pation_id";
    return $sql;
}
function countReservation($type)
{
    $sql = "SELECT COUNT(*) FROM `reservations_pation` WHERE `type_reservation` = '$type'";
    return $sql;
}
function allReservation()
{
    $sql = "SELECT COUNT(*) FROM `reservations_pation`";
    return $sql;
}
function contactRead($clinic_id)
{
    $sql = "SELECT * FROM `contact` WHERE `clinic_id` = $clinic_id";
    return $sql;
}
