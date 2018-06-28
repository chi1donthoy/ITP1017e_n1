
<?php require_once '../Mysql/myconnect.php';?>
<?php
$id = $_GET['id'];
$sql_find_img = "SELECT *FROM truyen_songngu";
$query_find_img = mysqli_query($conn,$sql_find_img);
$img_truyen = mysqli_fetch_assoc($query_find_img);
unlink("../upload/".$img_truyen['hinh_anh']);
$sql_delete_truyen = "DELETE FROM truyen_songngu WHERE id_truyen = $id";
mysqli_query($conn,$sql_delete_truyen);
header('Location:list_truyen.php');
