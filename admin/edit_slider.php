<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
			<?php 
				$id = $_GET['id'];
				$sql_find_silder = "SELECT *FROM slider WHERE id_slider = $id";
				$query_find_id   = mysqli_query($conn,$sql_find_silder);
				$data_slider     = mysqli_fetch_array($query_find_id);
				if(isset($_POST['btnSua'])){
					$title_slider = $_POST['tieude_slider'];
					$status_slider = $_POST['status'];
					if($_FILES['hinhanh']['name'] != NULL){
						if($_FILES['hinhanh']['type'] =="image/jpeg" 
							|| $_FILES['hinhanh']['type'] =="image/jpeg" 
							|| $_FILES['hinhanh']['type'] =="image/png" 
							|| $_FILES['hinhanh']['type'] =="image/gif"){
							  if($_FILES['hinhanh']['size'] > 1048576){
							  	echo "<p style='color:red;'>File không được quá 1 MB</p>";
							  }else{
							  	$name = $_FILES['hinhanh']['name'];
							  	$type = $_FILES['hinhanh']['type'];
							  	$size = $_FILES['hinhanh']['size'];

							  	unlink("../upload/".$data_slider['hinhanh']);

							  	move_uploaded_file($_FILES['hinhanh']['tmp_name'],"../upload/".$name);

							  	$sql_edit_video = "UPDATE slider SET tieude_slider = '$title_slider' , hinhanh = '$name' ,trangthai = $status_slider WHERE id_slider = $id";

							  	mysqli_query($conn,$sql_edit_video);
							  }
						}else{
							echo "<p style='color:red;'>File không phải là ảnh</p>";
						}
					}else{
						$name = $_POST['hinhanh1'];
						$sql_edit_video = "UPDATE slider SET tieude_slider = '$title_slider' , hinhanh = '$name',trangthai=$status_slider WHERE id_slider = $id";
						mysqli_query($conn,$sql_edit_video);
						
					}
				}
			?>
			<h3>Sửa slider</h3>
			<div class="form-group">
				<label>Tiêu Đề:</label>
				<input type="text" name="tieude_slider" class="form-control" placeholder="Tiêu đề" value="<?php echo $data_slider['tieude_slider'];?>">
			
			</div>
			<div class="form-group">
				<label>Hình ảnh</label>
				<img width="50px;" src="../upload/<?php echo $data_slider['hinhanh'];?>">
				<p></p>
				<input type="file" name="hinhanh" class="form-control" placeholder="Link"  >
				<input type="hidden" name="hinhanh1" class="form-control" placeholder="Link" value="<?php echo $data_slider['hinhanh'];?>">

			</div>
			
			<div class="form-group">
				<label style="display: block;">Trạng thái:</label>
				<?php
				if($data_slider['trangthai']==1){?>
					<label class="radio-inline"><input type="radio"  name="status" checked="checked" value="1">Hiển thị </label>
					<label class="radio-inline"><input type="radio" name="status" value="2">Không hiển thị</label>
				<?php }else{ ?>
					<label class="radio-inline"><input type="radio"  name="status"  value="1">Hiển thị </label>
					<label class="radio-inline"><input type="radio" name="status" checked="checked" value="2">Không hiển thị</label>
				<?php }
				?>
			</div>
			
			<input type="submit" name="btnSua" class="btn btn-primary" value="Sửa Slider">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
