<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
			<?php
				if(isset($_POST['btnThem'])){
					if(!empty($_POST['detai'])){
						$detai  = $_POST['detai'];
						
					}else{
						$err = array();
						if(empty($_POST['detai'])){
							$err[] = 'detai';
						}
					}
					if(empty($err)){
						$sql_add_detai = "INSERT INTO detail_kiemtra (ma_detail_ktra) VALUES('$detai')";
						 mysqli_query($conn,$sql_add_detai);
						 echo "<div class='alert alert-success'>Thêm thành công!</div>";
					}

				}
			?>
			<h3>Thêm mới đề tài</h3>
			<div class="form-group">
				<label>Đề tài kiểm tra:</label>
				<input type="text" name="detai" class="form-control" placeholder="Tên đề tài">
			<?php

				if(isset($err) && in_array('detai',$err)){
					echo "<p style = 'color:red;'>* Bạn chưa nhập đề tài *</p>";
				}
			?>
			</div>
			
			
			<input type="submit" name="btnThem" class="btn btn-primary" value="Thêm mới">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
