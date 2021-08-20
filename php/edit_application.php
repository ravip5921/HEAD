<?php
include "dbEdit.php";
sleep(1);
if (isset($_POST['id'])) {
    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];

    echo "$value -$column - $id";
    $editQuery = "UPDATE university SET $column = :value WHERE md5(id) = :id LIMIT 1";
    $query = $db->prepare($editQuery);
    $query->bindParam('value', $value);
    $query->bindParam('id', $id);
    if ($query->execute()) {
        echo "Edited";
    } else {
        echo "Err";
    }
    // $editQuery = "UPDATE university SET $column = :'$value' WHERE md5(id) = :'$id' LIMIT 1";

    // if ($sqldb->query($editQuery)) {
    //     echo "yay";
    // } else {
    //     echo "nay";
    // }
}
