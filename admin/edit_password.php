<?php include 'Model/header.php';?> 
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<?php
			if(isset($_SESSION['taikhoan'])){
				$taikhoan = $_SESSION['taikhoan'];
				$sql_find_tk = "SELECT *FROM user_admin WHERE taikhoan = '$taikhoan'";
				$query_find_tk = mysqli_query($conn,$sql_find_tk);
				$data_user = mysqli_fetch_array($query_find_tk);
				/*echo "<pre>";
				print_r($data_user);*/
			}

		?>
			<h3>Đổi mật khẩu:</h3>
			<div class="form-group">
				<label>Tài Khoản:</label>
				<input type="text" name="taikhoan" class="form-control" placeholder="Tiêu đề" value="<?php if(isset($_SESSION['taikhoan'])){echo $_SESSION['taikhoan'];}  ?>" disabled>
			
			</div>
			<div class="form-group">
				<label>Mật khẩu</label>
				<input type="text" name="matkhaucu" class="form-control" placeholder="Mật khẩu cũ"  >
				
			</div>
			<div class="form-group">
				<label>Mật khẩu mới:</label>
				<input type="text" name="matkhaumoi" class="form-control" placeholder="Mật khẩu mới" >
			
			</div>
			<div class="form-group">
				<label style="display: block;">Trang thái:</label>
				<?php
				if($data_user['quyen']==1) {?>
					<label class="radio-inline"><input type="radio"  name="status" checked="checked" value="1">Hoạt động</label>
				    <label class="radio-inline"><input type="radio" name="status" value="2">Tạm khóa</label>
				<?php }else{?>
					<label class="radio-inline"><input type="radio"  name="status"  value="1">Hoạt động </label>
				    <label class="radio-inline"><input type="radio" name="status" checked="checked" value="2">Tạm khóa</label>
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
