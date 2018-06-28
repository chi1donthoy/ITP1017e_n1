<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST">
			<?php
			if(isset($_POST['btnThem'])){
				if(!empty($_POST['title']) && !empty($_POST['link']) && !empty($_POST['noidung']) && !empty($_POST['status'])){
					$tieude = $_POST['title'];
					$link = $_POST['link'];
					$noidung = $_POST['noidung'];
					$trangthai = $_POST['status'];			
				}else{
					$err = array();
					if(empty($_POST['title'])){
						$err[]='title';
					}
					if(empty($_POST['link'])){
						$err[]='link';
					}
					if(empty($_POST['noidung'])){
						$err[]='noidung';
					}


				}
				if(empty($err)){
					$sql ="INSERT INTO video (tieude,linkvideo,noidung,trangthai) VALUES ('$tieude','$link','$noidung',$trangthai)";
					$query = mysqli_query($conn,$sql);
					echo "<div class='alert alert-success'><p>Thêm video thành công</p></div>";
				}else{
					echo "<div class='alert alert-danger'><p>Thêm mới thất bại</p></div>";
				}
			}
			?>
			<h3>Thêm mới video</h3>
			<div class="form-group">
				<label>Tiêu Đề:</label>
				<input type="text" name="title" class="form-control" placeholder="Tiêu đề">
			<?php
				if(isset($err) && in_array('title', $err)){
					echo "<p style='color:red'>*Tiêu đề không được để trống</p>";
				}

			?>
			</div>
			<div class="form-group">
				<label>Link:</label>
				<input type="text" name="link" class="form-control" placeholder="Link"  >
				<?php
				if(isset($err) && in_array('title', $err)){
					echo "<p style='color:red'>*Link không được để trống</p>";
				}

			?>
			</div>
			<div class="form-group">
				<label>Nội dung:</label>
				<input type="text" name="noidung" class="form-control" placeholder="Tiêu đề" >
			<?php
				if(isset($err) && in_array('title', $err)){
					echo "<p style='color:red'>*Nội dung không được để trống</p>";
				}

			?>
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
