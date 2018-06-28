<?php
require_once '../Mysql/myconnect.php';
$id = $_GET['id'];
$sql_delete = "DELETE FROM kho_tu_moi WHERE id_tu_moi = $id";
mysqli_query($conn,$sql_delete);
header('Location:tudien.php');