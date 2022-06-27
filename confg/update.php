<?php
// Pation it's done visit
function visit($id_reservation)
{
    $sql = "UPDATE `reservations_pation` SET `status`='1' WHERE `id`='$id_reservation'";
    return $sql;
}
