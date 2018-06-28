<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
			<?php
				$id = $_GET['id'];
				$sql_id = "SELECT *FROM detail_kiemtra WHERE id_detail_ktra =$id";
				$query_id = mysqli_query($conn,$sql_id);
				$data_detai = mysqli_fetch_array($query_id);
				if(isset($_POST['btnSua'])){
					$detai  = $_POST['detai'];
					$sql_detai_edit = "UPDATE detail_kiemtra SET ma_detail_ktra = '$detai' WHERE id_detail_ktra = $id";
					 $sql_edit_edit = mysqli_query($conn,$sql_detai_edit);
					 echo "<div class='alert alert-success'>Sửa thành công</div>";
					 $_POST['detai']  = '';
				}
			?>
			<h3>Thêm mới đề tài</h3>
			<div class="form-group">
				<label>Đề tài kiểm tra:</label>
				<input type="text" name="detai" class="form-control" placeholder="Tên đề tài" value="<?php echo $data_detai['ma_detail_ktra']?>">
			<?php

				if(isset($err) && in_array('detai',$err)){
					echo "<p style = 'color:red;'>* Bạn chưa nhập đề tài *</p>";
				}
			?>
			</div>
			
			
			<input type="submit" name="btnSua" class="btn btn-primary" value="Sửa">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
