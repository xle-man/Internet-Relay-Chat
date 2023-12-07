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
    while (time() - $time < 1) {
        $sql = 'SELECT * FROM messages WHERE id > ' . $lastID;
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $output['status'] = true;
                $output['data'] = 
                    '<div class="message">[' . $row['timestamp'] . ']<@' . $row['nickname'] . '>' . $row['message'] . '</div>';

                sleep(1);
            }
        }
    }
    echo json_encode($output);

    mysqli_close($conn);
?>