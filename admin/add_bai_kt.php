<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
		<?php 
				$sql_find_detai   = "SELECT *FROM detail_kiemtra";
				$query_find_detai = mysqli_query($conn,$sql_find_detai);
				if(isset($_POST['btnThem'])){
					if(!empty($_POST['ma_bai_ktra']) && !empty($_POST['noi_dung']) && !empty($_POST['loi_giai'])){
						$ma_bai_ktra = $_POST['ma_bai_ktra'];
						$noi_dung    = $_POST['noi_dung'];
						$loi_giai    = $_POST['loi_giai'];
						$id_detail_ktra    = $_POST['id_detail_ktra'];
					}else{
						$err = array();
						if(empty($_POST['ma_bai_ktra'])){
							$err[]='ma_bai_ktra';
						}
						if(empty($_POST['noi_dung'])){
							$err[]='noi_dung';
						}
						if(empty($_POST['loi_giai'])){
							$err[]='loi_giai';
						}
					}
					if(empty($err)){
						$sql_add_bai_kt = "INSERT INTO bai_kiem_tra(ma_bai_ktra,noi_dung,loi_giai,id_detail_ktra) VALUES ('$ma_bai_ktra','$noi_dung','$loi_giai',$id_detail_ktra)";
						$query_add_bat_kt=mysqli_query($conn,$sql_add_bai_kt);
						echo "<div class='alert alert-success'><p>Thêm mới thành công !</p></div>";
					}
					
				}
				
		?>
			<h3>Thêm mới bài kiểm tra:</h3>
			<div class="form-group">
				<label>Tên bài kiểm tra</label>
				<input type="text" name="ma_bai_ktra" class="form-control" placeholder="Tiêu đề">
		<?php
			if(isset($err) && in_array('ma_bai_ktra',$err)){
				echo "<p style='color:red'>* Bạn chưa nhập tiêu đề *</p>";
			}
		?>
			</div>
			<div class="form-group">
				<label for="sel1">Đề tài kiểm tra:</label>
				    <select class="form-control" name="id_detail_ktra" id="sel1">
				    	<?php
				    		while($data_find_detai = mysqli_fetch_array($query_find_detai)){?>
										<option value="<?= $data_find_detai['id_detail_ktra']?>"><?= $data_find_detai['ma_detail_ktra']?></option>
				    	<?php	}
				    	?>
				     </select>
			</div>
			<div class="form-group">
				<label>Nội dung:</label>
				<textarea  name="noi_dung"></textarea> 
				<?php
			if(isset($err) && in_array('noi_dung',$err)){
				echo "<p style='color:red'>* Bạn chưa nhập nội dung *</p>";
			}
		?>
			</div>
			<div class="form-group">
				<label>Lời giải</label>
				<textarea  name="loi_giai" ></textarea> 
		<?php
			if(isset($err) && in_array('loi_giai',$err)){
				echo "<p style='color:red'>* Bạn chưa nhập lời giải *</p>";
			}
		?>
			</div>
			
			<input type="submit" name="btnThem" class="btn btn-primary" value="Thêm mới">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
</div>
<?php include 'Model/footer.php';?>
