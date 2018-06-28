<?php 
require_once '../Mysql/myconnect.php';
	$id = $_GET['id'];
	$sql_delete_detai = "DELETE FROM detail_kiemtra WHERE id_detail_ktra = $id";
	mysqli_query($conn,$sql_delete_detai);
	header('Location:list_detai_kt.php');