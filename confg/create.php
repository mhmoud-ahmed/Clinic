<?php

function addReservation($pation_id, $clinic_id, $reser_type, $date)
{
    $sql = "INSERT INTO `reservations_pation`(
        `pation_id`,
        `clinic_id`,
        `type_reservation`,
        `date`
    )
    VALUES(
        '$pation_id',
        '$clinic_id',
        '$reser_type',
        '$date'
    )";
    return $sql;
}
function insertAddres($covernorate, $city)
{
    $sql = "INSERT INTO `addreess`(`covernorate`, `city`)
    VALUES('$covernorate', '$city')";
    return $sql;
}
function insertPation($fName, $lName, $phone, $code, $age, $gender, $address_id)
{
    $sql = "INSERT INTO `pationes`(
        `first_name`,
        `last_name`,
        `phone`,
        `code`,
        `age`,
        `gender`,
        `addrese_id`
    )
    VALUES('$fName', '$lName', '$phone', '$code', '$age', '$gender', '$address_id')";
    return $sql;
}
function insertxRay($name, $date, $imgName, $pation_id)
{
    $sql = "INSERT INTO `x_rays`(`name`, `date`, `image`, `file_id`)
    VALUES(
        '$name',
        '$date',
        '$imgName',
        (
        SELECT
            `files`.`id`
        FROM
            `files`
        WHERE
            `patione_id` = $pation_id
    )
    )";
    return $sql;
}
function insertAnalyses($name, $date, $imgName, $pation_id)
{
    $sql = "INSERT INTO `medical_analyses`(`name`, `date`, `image`, `file_id`)
    VALUES(
        '$name',
        '$date',
        '$imgName',
        (
        SELECT
            `files`.`id`
        FROM
            `files`
        WHERE
            `patione_id` = $pation_id
    )
    )";
    return $sql;
}
