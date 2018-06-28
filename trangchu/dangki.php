<?php include('Mysql/myconnect.php');?>

<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<title>Nhật Kí Online</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- //Meta-Tags -->

<link href="formcss/popuo-box.css" rel="stylesheet" type="text/css" media="all" />

<!-- Style --> <link rel="stylesheet" href="form/css/style.css" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>

	<h1>Từ Điển Online</h1>

	<div class="w3layoutscontaineragileits">
	<h2>Đăng Kí</h2>
		<form action="" method="post">
			<?php
				if(isset($_POST['btndangki'])){
					if(!empty($_POST['email'])&&!empty($_POST['matkhau'])&&!empty($_POST['xacnhanmatkhau'])&&!empty($_POST['dienthoai'])){
						$email = $_POST['email'];
						$matkhau = $_POST['matkhau'];
						$xacnhanmatkhau = $_POST['xacnhanmatkhau'];
						$dienthoai = $_POST['dienthoai'];
						if($matkhau == $xacnhanmatkhau){
								$matkhau = md5($matkhau);
						}else{
							$mess = array();
							if($matkhau != $xacnhanmatkhau){
								$mess[] = 'xacnhanmatkhau';
							}
						}
					}else{
						$err = array();
						if(empty($_POST['email'])){
							$err[]='email';
						}
						if(empty($_POST['matkhau'])){
							$err[]='matkhau';
						}
						if(empty($_POST['dienthoai'])){
							$err[]='dienthoai';
						}
					}
					if(empty($err) && empty($mess)){
						$sql_email = "SELECT *FROM user WHERE email = '$email' ";
						$query_email = mysqli_query($conn,$sql_email);
						$sql_dienthoai = "SELECT *FROM user WHERE dienthoai = '$dienthoai' ";
						$query_dienthoai = mysqli_query($conn,$sql_dienthoai);
						if(mysqli_num_rows($query_email)==1){
							 echo "<div class='alert alert-success'>Email đã tồn tại!</div>";
						}elseif(mysqli_num_rows($query_dienthoai)==1){
							echo "<div class='alert alert-success'>Điện thoại đã tồn tại!</div>";
						}else{
							$sql_user = "INSERT INTO user (email,matkhau,dienthoai) VALUES('{$email}','{$matkhau}','{$dienthoai}')";
						$query_user = mysqli_query($conn,$sql_user);
						echo "<div class='alert alert-success'>Đăng kí thành tài khoản thành công!!</div>";
						}
						
					}

				}
			?>
			<div class="form-group">
				<input type="email" placeholder="Email" name="email">
			<?php
			if(isset($err) && in_array('email',$err)){
				echo "<p style='color:red'>*Bạn chưa nhập email!*</p>";
			}
			?>
			</div>
			<div class="form-group">
				<input type="password" placeholder="Mật Khẩu" name="matkhau" >
			<?php
			if(isset($err) && in_array('matkhau',$err)){
				echo "<p style='color:red'>*Bạn chưa nhập mật khẩu*</p>";
			}
			?>
			</div>
			<div class="form-group"><input type="password" placeholder="Xác nhận mật khẩu" name="xacnhanmatkhau">
			<?php
			if(isset($mess) && in_array('xacnhanmatkhau',$mess)){
				echo "<p style='color:red'>*Mật khẩu không khớp!</p>";
			}
			?></div>
			<div class="form-group">
				<input type="text"  placeholder="Điện thoại" name="dienthoai">
			<?php
			if(isset($err) && in_array('dienthoai',$err)){
				echo "<p style='color:red'>*Bạn chưa nhập điện thoại*</p>";
			}
			?>
			</div>
			
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="Đăng kí" name="btndangki">
				<div class="clear"></div>
			</div>
		</form>
	</div>
	
	<!-- for register popup -->
	
	<!-- //for register popup -->
	
	<div class="w3footeragile">
		<p> &copy; FORM: Trần Duy Đạt <a href="#" target="_blank">Đại Học Công Nghiệp Hà Nội</a></p>
	</div>

	
	<script type="text/javascript" src="form/js/jquery-2.1.4.min.js"></script>

	<!-- pop-up-box-js-file -->  
	<script src="form/js/jquery.magnific-popup.js" type="text/javascript"></script>
	<!--//pop-up-box-js-file -->

</body>
<!-- //Body -->

</html>