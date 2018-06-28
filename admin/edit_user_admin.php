<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST">
			<?php
				$id = $_GET['id'];
				$sql_id = "SELECT *FROM user_admin WHERE id_admin = $id";
				$query = mysqli_query($conn,$sql_id);
				$data = mysqli_fetch_array($query);
				/*echo"<pre>";
				print_r($data);*/
				if(isset($_POST['btnSua'])){
					$hoten = $_POST['hoten'];
					$dienthoai = $_POST['dienthoai'];
					$email = $_POST['email'];
					$quyen = $_POST['quyen'];
					$sql = "UPDATE user_admin SET ten = '$hoten',email = '$email',quyen = '$quyen' WHERE id_admin =$id";
					mysqli_query($conn,$sql);
					echo "<div class='alert alert-success'><p>Sửa thành công</p></div>";
				}
			?>
			<h3>Thêm mới User</h3>
			<div class="form-group">
				<label>Tài Khoản</label>
				<input type="text" name="taikhoan" class="form-control"  value ="<?php echo $data['taikhoan']?>" disabled>
				<input type="hidden" name="taikhoan" class="form-control"  value ="<?php echo  $data['taikhoan']?>">
			
			</div>
			<div class="form-group">
				<label>Họ Tên</label>
				<input type="text" name="hoten" class="form-control" value ="<?php echo  $data['ten']?>">
			
			</div>
			<div class="form-group">
				<label>Điện thoại</label>
				<input type="text" name="dienthoai" class="form-control"  value ="<?php echo $data['dienthoai']?>">
				
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" value ="<?php echo $data['email']?>">
			</div>
			
			<div class="form-group">
				<label style="display: block;">Phân quyền</label>
				<?php
				if($data['quyen']==1){?>
					<label class="radio-inline"><input type="radio"  name="quyen" checked="checked" value="1">Admin</label>
					<label class="radio-inline"><input type="radio" name="quyen" value="2">Thường</label>
				<?php
			}else{?>
					<label class="radio-inline"><input type="radio"  name="quyen"  value="1">Admin</label>
					<label class="radio-inline"><input type="radio" name="quyen" checked="checked" value="2">Thường</label>
			<?php }
				?>
			
				
			</div>
			
			<input type="submit" name="btnSua" class="btn btn-primary" value="Sửa User">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>