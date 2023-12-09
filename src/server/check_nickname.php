<?php
    include './db_connection.php';

    function generateRandomColorHex(){
        $color = '#';
        for($i = 0; $i < 6; $i++){
            $color .= dechex(rand(0, 15));
        }
        return $color;
    }

    $nickname = $_GET['nickname'];

    if(isset($nickname)){
        $sql = "SELECT * FROM users WHERE nickname='$nickname'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            echo json_encode(['result' => false]);
        }else{
            $color = generateRandomColorHex();

            $sql = "INSERT INTO users (id,nickname,color) VALUES (NULL,'$nickname','$color')";
            mysqli_query($conn, $sql);

            echo json_encode(['result' => true]);
        }
    }

    mysqli_close($conn);
?>