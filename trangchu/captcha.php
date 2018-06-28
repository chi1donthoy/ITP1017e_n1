<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php
	if(isset($_POST['gui'])){
		if($_POST['capcha'] == $_SESSION['cap_code']){
			
			echo "Đúng";
		}else{
			
			echo "Sai";
		}
	}
	?>
	<form action="" method="post">
		<div class="form">
			<table >
				<tr>
					<td><input type="text" name="capcha" id = "capcha"></td>
					<td><img src="capcha_code.php"></td>
				</tr>
				<tr>
					<td><input type="submit" name="gui" value="Nhập"></td>
					
				</tr>
			</table>
		</div>
	</form>
</body>