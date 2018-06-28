<?php include 'Model/header.php';?> 
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST">
			<?php
				$id = $_GET['id'];
				$sql_edit = "SELECT *FROM video WHERE id_video = $id";
				$query_edit = mysqli_query($conn,$sql_edit);
				$data_video = mysqli_fetch_array($query_edit);
				/*echo "<pre>";
				print_r($data_video);*/
				if(isset($_POST['btnSua'])){
					$tieude = $_POST['title'];
					$link = $_POST['link'];
					$noidung = $_POST['noidung'];
					$trangthai = $_POST['status'];
					$sql_edit_video = "UPDATE video SET tieude = '$tieude',linkvideo = '$link',noidung = '$noidung',trangthai = $trangthai WHERE id_video =$id";
					 $result = mysqli_query($conn,$sql_edit_video);
							echo "<div class='alert alert-success'><p>Sửa video thành công</p></div>";
				}
			?>
			<h3>Sửa video</h3>
			<div class="form-group">
				<label>Tiêu Đề:</label>
				<input type="text" name="title" class="form-control" placeholder="Tiêu đề" value="<?php echo $data_video['tieude'];?>">
			
			</div>
			<div class="form-group">
				<label>Link:</label>
				<input type="text" name="link" class="form-control" placeholder="Link" value="<?php echo $data_video['linkvideo'];?>" >
				
			</div>
			<div class="form-group">
				<label>Nội dung:</label>
				<input type="text" name="noidung" class="form-control" placeholder="Tiêu đề" value="<?php echo $data_video['noidung'];?>">
			
			</div>
			<div class="form-group">
				<label style="display: block;">Trang thái:</label>
				<?php
				if($data_video['trangthai']==1) {?>
					<label class="radio-inline"><input type="radio"  name="status" checked="checked" value="1">Hiển thị </label>
				    <label class="radio-inline"><input type="radio" name="status" value="2">Không hiển thị</label>
				<?php }else{?>
					<label class="radio-inline"><input type="radio"  name="status"  value="1">Hiển thị </label>
				    <label class="radio-inline"><input type="radio" name="status" checked="checked" value="2">Không hiển thị</label>
				<?php
			}
				?>
			</div>
			
			<input type="submit" name="btnSua" class="btn btn-primary" value="Update">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>
