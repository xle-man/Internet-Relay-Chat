<?php
    include './db_connection.php';

    $lastID = isset($_GET["lastID"]) ? $_GET["lastID"] : null;

    $output = array(
        "status" => false,
        "lastID" => $lastID
    );

    $time = time();
    while (time() - $time < 10) {
        $sql = 'SELECT messages.id,messages.timestamp,messages.message,messages.id_nickname,users.color,users.nickname FROM messages,users WHERE messages.id_nickname = users.id and messages.id > ' . $lastID;
        
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $data = "";
            while($row = mysqli_fetch_assoc($result)){
                $ID = $row['id'];
                $timestamp = $row['timestamp'];
                $msg = $row['message'];
                $nicknameID = $row['id_nickname'];

                $nickname = $row['nickname'];
                $color = $row['color'];

                $data .= '<li class="message"><span style="color:#7CB9E8">[' . $timestamp . '] </span><@<span style="color:' . $color . '">' . $nickname . '</span>> <span class="e-message">' . $msg . '</span></li>';

                $output["status"] = true;
                $output["lastID"] = $ID;
            }
            
            $output["data"] = $data;
            echo json_encode($output);
            break;
        }
        usleep(5000);
    }

    // echo json_encode($output);

    mysqli_close($conn);
?>