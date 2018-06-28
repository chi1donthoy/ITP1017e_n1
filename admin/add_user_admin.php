<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST">
			<?php

			if(isset($_POST['btnThem'])){
				if(!empty($_POST['taikhoan'])&&!empty($_POST['matkhau'])&&!empty($_POST['xnmatkhau'])&&!empty($_POST['hoten'])&&!empty($_POST['dienthoai'])&&!empty($_POST['email'])){
						$matkhau = $_POST['matkhau'];
						$taikhoan = $_POST['taikhoan'];
						$xnmatkhau = $_POST['xnmatkhau'];
						$hoten =$_POST['hoten'];
						$dienthoai = $_POST['dienthoai'];
						$email = $_POST['email'];
						$quyen = $_POST['quyen'];
					if($matkhau == $xnmatkhau){
						$matkhau = md5($matkhau);
					}else{
						$mess = array();
						$mess[]='xnmatkhau';
					}
					if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)==TRUE){
						$email = mysqli_real_escape_string($conn,$_POST['email']);
					}else{
						$mess[]='email';
					}
					

				}else{
					$err = array();
					if(empty($_POST['taikhoan'])){
						$err[]='taikhoan';
					}
					if(empty($_POST['matkhau'])){
						$err[]='matkhau';
					}
					if(empty($_POST['hoten'])){
						$err[]='hoten';
					}
					if(empty($_POST['email'])){
						$err[]='email';
					}
					if(empty($_POST['dienthoai'])){
						$err[]='dienthoai';
					}
				}
				if(empty($err) && empty($mess)){
					$sql_kt_tai_khoan = "SELECT taikhoan FROM user_admin WHERE taikhoan = '$taikhoan'";
					$query_kt_tai_khoan = mysqli_query($conn,$sql_kt_tai_khoan);
					$kt_tk = mysqli_num_rows($query_kt_tai_khoan);
					$sql_kt_email = "SELECT email FROM user_admin WHERE email = '$email'";
					$query_kt_email = mysqli_query($conn,$sql_kt_email);
					$kt_email = mysqli_num_rows($query_kt_email);
						if($kt_tk==1){
							echo "Tài khoản đã tồn tại";
						}elseif($kt_email==1){
							echo "Email tồn tại";
						}else{
							$sql = "INSERT INTO user_admin(taikhoan,matkhau,ten,dienthoai,email,quyen) VALUES('$taikhoan','$matkhau','$hoten',$dienthoai,'$email',$quyen)";
					mysqli_query($conn,$sql);
						
						echo "<div class='alert alert-success'><p>Thêm thành công<p></div>";
						}
					
				}else{
					echo "<div class='alert alert-danger'><p>Thêm thất bại!!!<p></div>";
			
			}
		}
			?>
			
			<h3>Thêm mới User</h3>
			<div class="form-group">
				<label>Tài Khoản</label>
				<input type="text" name="taikhoan" class="form-control"  value ="<?php if(isset($_POST['taikhoan'])){echo $_POST['taikhoan'];}?>">
				<?php
				if(isset($err) && in_array('taikhoan',$err)){
					echo "<p style='color:red;'>*Tài khoản không được để trống</p>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Mật Khẩu</label>
				<input type="password" name="matkhau" class="form-control"  value ="<?php if(isset($_POST['matkhau'])){echo $_POST['matkhau'];}?>">
				<?php
				if(isset($err) && in_array('taikhoan',$err)){
					echo "<p style='color:red;'>*Mật khẩu không được để trống</p>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Xác Nhận Mật Khẩu</label>
				<input type="password" name="xnmatkhau" class="form-control"  value ="<?php if(isset($_POST['xnmatkhau'])){echo $_POST['xnmatkhau'];}?>">
				<?php
				if(isset($mess) && in_array('xnmatkhau',$mess)){
					echo "<p style='color:red;'>*Mật khẩu không khớp</p>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Họ Tên</label>
				<input type="text" name="hoten" class="form-control" value ="<?php if(isset($_POST['hoten'])){echo $_POST['hoten'];}?>">
			<?php
				if(isset($err) && in_array('hoten',$err)){
					echo "<p style='color:red;'>*Họ tên không được để trống</p>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Điện thoại</label>
				<input type="text" name="dienthoai" class="form-control"  value ="<?php if(isset($_POST['dienthoai'])){echo $_POST['dienthoai'];}?>">
				<?php
				if(isset($err) && in_array('taikhoan',$err)){
					echo "<p style='color:red;'>*Điện thoại không được để trống</p>";
				}
				?>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" value ="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
				<?php
				if(isset($err) && in_array('email',$err)){
					echo "<p style='color:red;'>*Email không được để trống</p>";
				}
				if(isset($mess) && in_array('email',$mess)){
					echo "<p style='color:red;'>*Email không hợp lệ</p>";
				}
				?>
			</div>
			
			<div class="form-group">
				<label style="display: block;">Phân quyền</label>
				<label class="radio-inline"><input type="radio"  name="quyen" checked="checked" value="1">Admin</label>
				<label class="radio-inline"><input type="radio" name="quyen" value="2">Thường</label>
			</div>
			
			<input type="submit" name="btnThem" class="btn btn-primary" value="Thêm mới User">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
<?php include 'Model/footer.php';?>