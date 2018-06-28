<?php
session_start();
if(!isset($_SESSION['email'])){
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Từ Điển Tiếng Anh Online</title>
	<meta charset="utf-8">
	<meta name="author" content="pixelhint.com">
	<meta name="description" content="Minima is a minimal, clean HTML5 multi-purpose template, well-coded & commented code"/>
	<link rel="stylesheet" type="text/css" href="css_trangchu/reset.css">
	<link rel="stylesheet" type="text/css" href="css_trangchu/main.css">
    <script type="text/javascript" src="js_trangchu/jquery.js"></script>

     <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<header>

		<div class="wrapper">
			<a href="#" class="logo"> <img src="img/logo_header.png" width="150px" height="150px" alt="" title="Minima"/> </a>
			<nav>
				<ul>
					<li><a href="trangchu.php">Trang chủ</a></li>
					<li><a href="tudien.php">Từ Điển</a></li>
					<li><a href="list_video_tc.php">Học qua video</a></li>
					<li><a href="list_truyen.php">Truyện Đọc</a></li>
					<li><a href="">Liên Hệ</a></li>
					<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Xin chào:&nbsp; <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""><i class="fa fa-fw fa-user"></i>Hồ Sơ </a>
                        </li>                        
                        <li>
                            <a href="doimatkhau.php"><i class="fa fa-fw fa-gear"></i>Đổi mật khẩu</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="dangxuat.php"><i class="fa fa-fw fa-power-off"></i>Đăng xuất</a>
                        </li>
                    </ul>
                </li>
				</ul>
			</nav>
		</div>
		
	</header><!-- End Header -->
