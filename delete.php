<?php

include "koneksi.php";

$id = $_GET['id'];
$query = "DELETE FROM todo WHERE id=$id";

$sql = mysqli_query($conn, $query);

// if ($sql){
    // echo "Data Berhasil Dihapus";
// }

header('Location: index.php');