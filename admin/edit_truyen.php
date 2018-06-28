<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
		<?php 
			$id = $_GET['id'];
			$sql_edit_truyen = "SELECT *FROM truyen_songngu WHERE id_truyen = $id";
			$query_edit = mysqli_query($conn,$sql_edit_truyen);
			$data_edit_truyen = mysqli_fetch_assoc($query_edit);
			/*echo $data_edit_truyen['hinh_anh'];*/
			if(isset($_POST['btnSua'])){
				$tieu_de = $_POST['tieu_de'];
				$tom_tat = $_POST['tom_tat'];
				$noi_dung = $_POST['noi_dung'];
				if($_FILES['file']['name'] != NULL){
					if($_FILES['file']['type'] =="image/jpeg" || $_FILES['file']['type'] =="image/jpg" || $_FILES['file']['type'] =="image/png"|| $_FILES['file']['type'] =="image/gif"){
						if($_FILES['file']['size'] >1000000){
							echo "<p style='color:red'>File không được quá 2Mb</p>";
						}else{

							$name = $_FILES['file']['name'];
							//xóa ảnh khỏi file
							unlink("../upload/".$data_edit_truyen['hinh_anh']);
							//upload file vào trng thư mục
							move_uploaded_file($_FILES['file']['tmp_name'],"../upload/".$name);
							echo "<div class='alert alert-success'>Sửa thành công!</div>";
							$sql = "UPDATE truyen_songngu SET  tieu_de = '$tieu_de',tom_tat='$tom_tat',noi_dung_truyen ='$noi_dung',hinh_anh = '$name' WHERE id_truyen=$id";
							$result = mysqli_query($conn,$sql);
							$sql_edit_truyen = "SELECT *FROM truyen_songngu WHERE id_truyen = $id";
							$query_edit = mysqli_query($conn,$sql_edit_truyen);
							$data_edit_truyen = mysqli_fetch_assoc($query_edit);
						}
					}else{
						echo "<p style='color:red'>File không đúng định dạng!</p>";
					}
				}else{
					$name = $_POST['file1'];
					$sql = "UPDATE truyen_songngu SET  tieu_de = '$tieu_de',tom_tat='$tom_tat',noi_dung_truyen ='$noi_dung',hinh_anh = '$name'  WHERE id_truyen=$id";
					$result = mysqli_query($conn,$sql);
				}
			}
		?>
			<h3>Thêm mới truyện:</h3>
			<div class="form-group">
				<label>Tiêu Đề:</label>
				<input type="text" name="tieu_de" class="form-control" placeholder="Tiêu đề" value="<?php echo $data_edit_truyen['tieu_de'];?>">
		
			</div>
			<div class="form-group">
				<label>Hình ảnh</label>
				<br>
				<img src="../upload/<?php echo $data_edit_truyen['hinh_anh'];?>" width="80px;">
				<p></p>
				<input type="file" name="file" class="form-control" placeholder="Link" >
				<input type="hidden" name="file1" value="<?php echo $data_edit_truyen['hinh_anh'];?>">
			</div>
			<div class="form-group">
				<label>Tóm tắt</label>
				<textarea name="tom_tat" style="width: 100%; height: 150px;"><?php echo $data_edit_truyen['tom_tat'];?></textarea>
			
			</div>
			<div class="form-group">
				<label>Nội dung</label>
				<textarea name="noi_dung" "><?php echo $data_edit_truyen['noi_dung_truyen'];?></textarea>
			</div>
			
		<div class="form-group">
			<input type="submit" name="btnSua" class="btn btn-primary" value="Sửa">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</div>
			
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
