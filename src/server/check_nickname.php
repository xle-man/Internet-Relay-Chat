<?php
    include './db_connection.php';

    function generateRandomColorHex(){
        $color = '#';
        for($i = 0; $i < 6; $i++){
            $color .= dechex(rand(0, 15));
        }
        return $color;
    }

    function getLastID(){
        global $conn;

        $sql = 'SELECT id FROM messages ORDER BY id DESC LIMIT 1';
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                return $row['id'];
            }
        }

        return 0;
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

            echo json_encode(['result' => true, 'lastID' => getLastID()]);
        }
    }

    mysqli_close($conn);
?>