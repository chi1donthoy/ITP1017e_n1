<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
		<?php
		if(isset($_POST['btnThem'])){
			if(!empty($_POST['tieu_de'])&&!empty($_POST['noi_dung'])&&!empty($_POST['tom_tat'])){
				$tieu_de  = $_POST['tieu_de'];
				$noi_dung_truyen = $_POST['noi_dung'];
				$tom_tat  = $_POST['tom_tat'];

			}else{
				$err = array();
				if(empty($_POST['tieu_de'])){
					$err[]='tieu_de';
				}
				if(empty($_POST['noi_dung'])){
					$err[]='noi_dung';
				}
				if(empty($_POST['tom_tat'])){
					$err[]='tom_tat';
				}
			}
			if(empty($err)){
				if($_FILES['file']['name'] != NULL){
					if($_FILES['file']['type'] == "image/jpeg" 
						||$_FILES['file']['type'] == "image/jpg" 
						||$_FILES['file']['type'] == "image/png" 
						||$_FILES['file']['type'] == "image/gif"){
						if($_FILES['file']['size'] >10000000){
							echo "<p style='color:red'>File không quá 2mb!</p>";
						}else{
							$name = $_FILES['file']['name'];
							move_uploaded_file($_FILES['file']['tmp_name'],"../upload/".$name);
							$sql_add_truyen = "INSERT INTO truyen_songngu (tieu_de,tom_tat,noi_dung_truyen,hinh_anh) VALUES('$tieu_de','$tom_tat','$noi_dung_truyen','$name')";
							mysqli_query($conn,$sql_add_truyen);
							echo "<div class='alert alert-success'>Thêm thành công!</div>";
						}
					}else{
						echo "<p style='color:red'>File không đúng định dạng!</p>";
					}
				}else{
					echo "<p style='color:red'>Bạn chưa chọn file</p>";
				}
			}
		}
		?>
			<h3>Thêm mới truyện:</h3>
			<div class="form-group">
				<label>Tiêu Đề:</label>
				<input type="text" name="tieu_de" class="form-control" placeholder="Tiêu đề">
		<?php
			if(isset($err) && in_array('tieu_de',$err)){
				echo "<p style='color:red'>*Bạn chưa nhập tiêu đề!!</p>";
			}
		?>
			</div>
			<div class="form-group">
				<label>Hình ảnh</label>
				<input type="file" name="file" class="form-control" placeholder="Link"  >
			</div>
			<div class="form-group">
				<label>Tóm tắt</label>
				<textarea name="tom_tat" style="width: 100%; height: 150px;"></textarea>
				<?php
			if(isset($err) && in_array('tom_tat',$err)){
				echo "<p style='color:red'>*Bạn chưa nhập tóm tắt!</p>";
			}
		?>
			</div>
			<div class="form-group">
				<label>Nội dung</label>
				<textarea name="noi_dung" "></textarea>
			</div>
			<?php
			if(isset($err) && in_array('noi_dung',$err)){
				echo "<p style='color:red'>*Bạn chưa nhập nội dụng !!</p>";
			}
		?>
		<div class="form-group">
			<input type="submit" name="btnThem" class="btn btn-primary" value="Thêm mới">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</div>
			
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
