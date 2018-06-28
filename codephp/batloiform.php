<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>
		<meta name='' content=''>
		<style type="text/css">
			.error
			{
				color:red;
				font-size:12px;
			}
		</style>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	</head>
	<body>
		<form name="frmform" id="formdm" method="POST">
			<table>
				<tr>
					<td>Tài khoản</td>
				</tr>
				<tr>
					<td><input type="text" name="taikhoan" value=""></td>
				</tr>
				<tr>
					<td>Mật khẩu</td>
				</tr>
				<tr>
					<td><input type="password" name="matkhau" id="matkhau" value=""></td>
				</tr>
				<tr>
					<td>Nhập lại mật khẩu</td>
				</tr>
				<tr>
					<td><input type="password" name="nhaplaimk" value=""></td>
				</tr>
				<tr>
					<td>Họ tên</td>
				</tr>
				<tr>
					<td><input type="text" name="hoten" value=""></td>
				</tr>
				<tr>
					<td>Địa chỉ</td>
				</tr>
				<tr>
					<td><input type="text" name="diachi" value=""></td>
				</tr>
				<tr>
					<td>Điện thoại</td>
				</tr>
				<tr>
					<td><input type="text" name="dienthoai" value=""></td>
				</tr>
				<tr>
					<td>Email</td>
				</tr>
				<tr>
					<td><input type="text" name="email" value=""></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="Gửi"></td>
				</tr>
			</table>
		</form>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#formdm").validate({
					rules: {
						taikhoan: {
							required:true,
							minlength: 5
						},
						matkhau: {
							required:true,
							minlength: 2	
						},
						nhaplaimk: {
							required:true,
							equalTo:"#matkhau"	
						},
						hoten:"required",
						diachi:"required",
						dienthoai:"required",
						email: {
							required:true,
							email:true	
						}
					},
					messages: {
						taikhoan: {
							required: "Tài khoản không được để trống",
							minlength: "Tài khoản phải lớn hơn 5 ký tự",	
						},
						matkhau: {
							required: "Mật khẩu không được để trống",
							minlength: "Tài khoản phải lớn hơn 2 ký tự",	
						},
						nhaplaimk: {
							required:"Nhập lại mật khẩu không để trống",
							equalTo:"Mật khẩu không giống nhau"	
						},
						hoten: "Họ tên không để trống",
						diachi: "Địa chỉ không để trống",
						dienthoai: "Điện thoại không để trống",
						email: {
							required: "Email không được để trống",	
							email: "Email mail không đúng định dạng"
						}
					}
				});
			});
		</script>
	</body>
</html>