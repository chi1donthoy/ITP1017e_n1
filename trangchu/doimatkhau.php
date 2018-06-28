<?php include('header.php');
require_once '../Mysql/myconnect.php';
?>
<br>
<hr>
<br>
<div class="container">

				<?php
					if(isset($_SESSION['email'])){
					$email = $_SESSION['email'];
					$sql_email = "SELECT *FROM user WHERE email = '$email'";
					$query_email = mysqli_query($conn,$sql_email);
					$data_email = mysqli_fetch_assoc($query_email);
					$id_us = $data_email['id_user'];
					/*echo "<pre>";
					print_r($data_email);*/
					if(isset($_POST['btnDoi'])){
						if(!empty($_POST['matkhau']) && !empty($_POST['xnmatkhau'])){
							$mess = array();
							$matkhau = $_POST['matkhau'];
							$xnmatkhau = $_POST['xnmatkhau'];
							if($matkhau != $xnmatkhau){
								$mess[]='xnmatkhau';
							}else{
								$matkhau = md5($matkhau);
							}
						}else{
							$err = array();
							if(empty($matkhau)){
								$err[]='matkhau';
							}
						}
						if(empty($err) && empty($mess)){
						$sql_update = "UPDATE user SET matkhau = '$matkhau' WHERE id_user = $id_us";
						mysqli_query($conn,$sql_update);
						echo "<div class='alert alert-success'>Đổi mật khẩu thành công</div>";
					}
					}

					}				
				?>
				<div class="col-sm-12" >
					 <div class="panel panel-info">
      						<div class="panel-heading">Thay đổi mật khẩu</div>
      						<div class="panel-body">   							
      							<div class="col-sm-4"></div>
      							<div class="col-sm-4">
      								<form action="" method="post" >
      									<div class="form-group">
      										<label>Email:</label>
      										<input type="text" name="email" disabled="disabled" class="form-control" value="<?php echo $data_email['email'];?>">
      									</div>
      									<div class="form-group">
      										<label>Mật khẩu mới:</label>
      										<input type="password" name="matkhau"  class="form-control">
      										<?php
      											if(isset($err)&&in_array('matkhau',$err)){
      												echo "<p style='color:red'>*Không được bỏ trống!!!</p>";
      											}
      										?>
      									</div>
      									<div class="form-group">
      										<label>Xác nhận mật khẩu mới:</label>
      										<input type="password" name="xnmatkhau"  class="form-control">
      										<?php
      											if(isset($mess)&&in_array('matkhau',$mess)){
      												echo "<p style='color:red'>*Mật khẩu không khớp!!!</p>";
      											}
      										?>
      									</div>
      									<input type="submit" name="btnDoi" class="btn btn-info btn-block" value="Đổi mật khẩu">
      								</form>
      							</div>
      							<div class="col-sm-4"></div>
   					 		</div>
					        
				</div>	
	</div>		
</div>
</div>
<?php include('footer.php');?>
