<?php
    include './db_connection.php';

    $nickname = $_GET['nickname'];

    if(isset($nickname)){
        $sql = "SELECT * FROM messages WHERE nickname='$nickname'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            echo json_encode(['result' => false]);
        }else{
            echo json_encode(['result' => true]);
        }
    }
?>