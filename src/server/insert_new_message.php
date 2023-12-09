<?php
    include 'db_connection.php';

    function deleteSurplus($conn){
        $sql = 'SELECT * FROM messages';
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >= 15){
            $sql = 'DELETE FROM messages WHERE id = (SELECT id FROM messages ORDER BY id ASC LIMIT 1)';
            mysqli_query($conn, $sql);
        }
    }

    function insertMessage($nickname, $msg, $conn) {
        $sql = "SELECT id FROM users WHERE nickname = '$nickname'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $id_nickname = $row['id'];

            $current_time = date("H:i:s");
            $sql = "INSERT INTO messages (id, timestamp, id_nickname, message) VALUES (null, '$current_time', '$id_nickname', '$msg')";
            
            mysqli_query($conn, $sql);
        }

    }

    if(isset($_GET["nickname"]) && isset($_GET["msg"])){
        deleteSurplus($conn);
        insertMessage($_GET["nickname"], $_GET["msg"], $conn);
    }

    mysqli_close($conn);
?>