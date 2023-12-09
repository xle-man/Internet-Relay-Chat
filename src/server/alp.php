<?php
    include './db_connection.php';

    function getLastID($conn){
        $sql = 'SELECT id FROM messages ORDER BY id DESC LIMIT 1';
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                return $row['id'];
            }
        }
    }

    $lastID = getLastID($conn);

    $output = array(
        "status" => false
    );

    $time = time();
    while (time() - $time < 0.5) {
        $sql = 'SELECT * FROM messages WHERE id > ' . $lastID;
        $result = mysqli_query($conn, $sql);

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $output['status'] = true;
                    $timestamp = $row['timestamp'];
                    $msg = $row['message'];

                    $sql = "SELECT * FROM messages, users WHERE users.id = " . $row['id_nickname'];
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $nickname = $row['nickname'];
                            $color = $row['color'];

                            $output['data'] = '<li class="message"><span style="color:#7CB9E8">[' . $timestamp . '] </span><@<span style="color:' . $color . '">' . $row['nickname'] . '</span>> <span class="e-message">' . $row['message'] . '</span></li>';
                        }
                    }

                    // usleep(100);
                }
            }
        }
    }
    echo json_encode($output);

    mysqli_close($conn);
?>