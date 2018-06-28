<?php
session_start();

?>
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
	<h2>Đăng nhập</h2>
		<form action="" method="post">
			<?php 
					if(isset($_POST['btnDN'])){
						if(!empty($_POST['email'])&&!empty($_POST['matkhau'])){
							$email = $_POST['email'];
							$matkhau = md5($_POST['matkhau']);
						}else{
							$err = array();
							if(empty($email)){
								$err[]='email';
							}
							if(empty($matkhau)){
								$err[]='matkhau';
							}
						}
						if(empty($err)){
							$sql_dn = "SELECT email,matkhau FROM user WHERE email = '$email' AND matkhau='$matkhau'";
							$query_dn = mysqli_query($conn,$sql_dn);
							if(mysqli_num_rows($query_dn)==1){
								
								$_SESSION['email']=$email;

								header('Location:trangchu/trangchu.php');
							}else{
								echo "<p style='color:red'>Tài khoản hoặc mật khẩu không đúng!</p>";
							}
						}
					}
			?>
			<?php 
				if(isset($err) && in_array('email',$err)){
					echo "<p style='color:red'>*Tài khoản không được đẻ trống!</p>";
				}
			?>
			<input type="text"  placeholder="Email" name="email">
            <?php 
				if(isset($err) && in_array('matkhau',$err)){
					echo "<p style='color:red'>*Mật khẩu không được để trống!</p>";
				}
			?>
			<input type="password"  placeholder="Mật Khẩu" name="matkhau">
			<ul class="agileinfotickwthree">
				<li>
					<input type="checkbox" id="brand1" value="">
					<label for="brand1"><span></span>Ghi nhớ</label>
					<a href="#">Quên mật khẩu ?</a>
				</li>
			</ul>
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="Đăng Nhập" name="btnDN">
				<p>Đăng kí tài khoản mới<span>→</span> <a  href="dangki.php">Đăng kí</a></p>
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
	<script>
		$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});
	</script>

</body>
<!-- //Body -->

</html>