<?php
    include './db_connection.php';

    function getLastID(){
        global $conn;

        $sql = 'SELECT id FROM messages ORDER BY id DESC LIMIT 1';
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                return $row['id'];
            }
        }
    }

    $lastID = getLastID();

    $output = "";
    $time = time();
    while (time() - $time < 10) {
        $output = "";

        $sql = 'SELECT * FROM messages WHERE id > ' . $lastID;
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $timestamp = $row['timestamp'];
            $msg = $row['message'];

            $sql = "SELECT * FROM messages, users WHERE users.id = " . $row['id_nickname'];
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                $nickname = $row['nickname'];
                $color = $row['color'];

                $output = '<li class="message"><span style="color:#7CB9E8">[' . $timestamp . '] </span><@<span style="color:' . $color . '">' . $nickname . '</span>> <span class="e-message">' . $msg . '</span></li>';

                echo $output;
                exit;
            }
        }
        usleep(500);
    }

    echo $output;
    mysqli_close($conn);
?>