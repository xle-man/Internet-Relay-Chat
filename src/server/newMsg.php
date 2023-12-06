<?php
    include 'db_connection.php';

    function insertMessage($nickname, $msg, $conn) {
        $current_time = date("H:i:s");
        $sql = "INSERT INTO messages (id, timestamp, nickname, message) VALUES (null,'$current_time','$nickname', '$msg')";

        mysqli_query($conn, $sql);
    }

    if(isset($_GET["nickname"]) && isset($_GET["msg"])){
        insertMessage($_GET["nickname"], $_GET["msg"], $conn);
    }


    mysqli_close($conn);
?>