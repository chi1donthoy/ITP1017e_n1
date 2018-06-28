<?php 
require_once '../Mysql/myconnect.php';
	$id = $_GET['id'];
	$sql_delete_detai = "DELETE FROM bai_kiem_tra WHERE id_bai_ktra = $id";
	mysqli_query($conn,$sql_delete_detai);
	header('Location:list_bai_kt.php');