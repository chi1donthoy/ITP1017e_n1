<?php
include('../Mysql/myconnect.php');
	$id = $_GET['id'];
	$sql_delete = "DELETE FROM video WHERE id_video = $id";
	$query_delete = mysqli_query($conn,$sql_delete);
	header('Location:list_video.php');
?>