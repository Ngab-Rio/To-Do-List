<?php

include "koneksi.php";


if (isset($_POST['create'])){
    $task = $_POST['task'];

    $query = "INSERT INTO users (task) VALUES ('$task')";

    $create = mysqli_query($conn, $query);

    if($create){
        echo "sukses";
    }else{
        echo "gagal";
    }
}


?>