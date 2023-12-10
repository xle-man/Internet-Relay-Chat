<?php
    include 'db_connection.php';

    function updateUsersTable($command, $value, $id) {
        global $conn;

        $column = substr($command, 1);
        $sql = "UPDATE users SET $column = '$value' WHERE id = '$id'";
        mysqli_query($conn, $sql);
    }
?>
