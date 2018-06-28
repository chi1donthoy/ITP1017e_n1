<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
			<?php
					if(isset($_POST['btnThem'])){
						if(!empty($_POST['tieude_slider']) &&!empty($_POST['status'])){
							$tieude_slider = $_POST['tieude_slider'];
							$status        = $_POST['status'];
							
						}else{
							$err = array();
							if(empty($_POST['tieude_slider'])){
								$err[]='tieude_slider';
							}
						}
						if(empty($err)){
							if($_FILES['hinhanh']['name'] != NULL){
								if($_FILES['hinhanh']['type']=="image/png"||$_FILES['hinhanh']['type']=="image/jpeg"||$_FILES['hinhanh']['type']=="image/gif"){
										if($_FILES['hinhanh']['size'] > 1048576 ){
											echo "<p>File không được quá 1MB</p>";
										}else{
											$name = $_FILES['hinhanh']['name'];
											$type = $_FILES['hinhanh']['type'];
											$size = $_FILES['hinhanh']['size'];
											$path = "../upload/";
											$tmp_name = $_FILES['hinhanh']['tmp_name'];

											  move_uploaded_file($tmp_name,$path.$name);
											  
											$sql_add_silder = "INSERT INTO slider (tieude_slider,hinhanh,trangthai) VALUES ('$tieude_slider','$name',$status)";
											$query_add_slider = mysqli_query($conn,$sql_add_silder);
											echo "<div class='alert alert-success'><p>Thêm mới thành công !</p></div>";
											/*echo $name;*/
										}
								}else{
									echo "<p style='color:red;'>File không đúng định dạng ảnh</p>";
								}
							}else{
								$name = '';
								echo "<p style='color:red;'>Bạn chưa chọn tệp!</p>";
							}
							
						}
					}

			?>
			<h3>Thêm mới slider</h3>
			<div class="form-group">
				<label>Tiêu Đề:</label>
				<input type="text" name="tieude_slider" class="form-control" placeholder="Tiêu đề">
			<?php
			if(isset($err) && in_array('tieude_slider', $err)){
				echo "<p style='color:red'>Bạn chưa nhập tiêu đề</p>";
			}
			?>
			</div>
			<div class="form-group">
				<label>Hình ảnh</label>
				<input type="file" name="hinhanh" class="form-control" placeholder="Link"  >
			</div>
			
			<div class="form-group">
				<label style="display: block;">Trang thái:</label>
				<label class="radio-inline"><input type="radio"  name="status" checked="checked" value="1">Hiển thị </label>
				<label class="radio-inline"><input type="radio" name="status" value="2">Không hiển thị</label>
			</div>
			
			<input type="submit" name="btnThem" class="btn btn-primary" value="Thêm mới">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
