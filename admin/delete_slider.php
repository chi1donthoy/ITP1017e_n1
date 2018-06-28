<?php
include '../mysql/myconnect.php';?>

<?php
	$id = $_GET['id'];
	//Xóa hình ảnh trong thư mục upload
	$sql = "SELECT hinhanh FROM slider WHERE id_slider =$id";
	$query_a = mysqli_query($conn,$sql);
	$anhInfor = mysqli_fetch_assoc($query_a);
	/*echo "<pre>";
	print_r($anhInfor);*/
	unlink('../upload/'.$anhInfor['hinhanh']);
	$query = "DELETE FROM slider WHERE id_slider =$id";
	$result = mysqli_query($conn,$query);
		header('Location:list_slider.php');
?>