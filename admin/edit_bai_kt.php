<?php include 'Model/header.php';?>
<?php require_once '../Mysql/myconnect.php';?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
		<form name="frmadd_video" method="POST" enctype="multipart/form-data">
			<?php
				    
					$sql_find_detai   = "SELECT *FROM detail_kiemtra";
					$query_find_detai = mysqli_query($conn,$sql_find_detai);
					$id = $_GET['id'];
					$sql_edit_bkt = "SELECT *FROM bai_kiem_tra WHERE id_bai_ktra = $id";
					$query_edit_bkt = mysqli_query($conn,$sql_edit_bkt);
					$data_bkt = mysqli_fetch_assoc($query_edit_bkt);
					$id_dt =$data_bkt['id_detail_ktra'];
					$sql_edit_dt = "SELECT *FROM detail_kiemtra WHERE id_detail_ktra = $id_dt";
					$query_edit_dt = mysqli_query($conn,$sql_edit_dt);
					$data_dt = mysqli_fetch_assoc($query_edit_dt);
					/*echo "<pre>";
					print_r($data_dt);*/
					if(isset($_POST['btnSua'])){
						$ma_bai_ktra = $_POST['ma_bai_ktra'];
						$noi_dung    = $_POST['noi_dung'];
						$loi_giai    = $_POST['loi_giai'];
						$id_detail_ktra  = $_POST['id_detail_ktra'];
						$sql_edit_all = "UPDATE bai_kiem_tra SET ma_bai_ktra = '$ma_bai_ktra',noi_dung='$noi_dung',loi_giai='$loi_giai',id_detail_ktra=$id_detail_ktra WHERE id_bai_ktra=$id";
						mysqli_query($conn,$sql_edit_all);
						echo "<div class='alert alert-success'>Sửa thành công!</div>";
					}

			?>
			<h3>Thêm mới bài kiểm tra:</h3>
			<div class="form-group">
				<label>Tên bài kiểm tra</label>
				<input type="text" name="ma_bai_ktra" class="form-control" placeholder="Tiêu đề" value="<?php echo $data_bkt['ma_bai_ktra'];?>">
		
			</div>
			<div class="form-group">
				<label for="sel1">Đề tài kiểm tra:</label>
				    <select class="form-control" name="id_detail_ktra" id="sel1">
				    	<option value="<?php echo$data_bkt['id_detail_ktra']?>"><?php echo $data_dt['ma_detail_ktra'];?></option>
				    	<?php
				    		while($data_find_detai = mysqli_fetch_array($query_find_detai)){?>
										<option value="<?= $data_find_detai['id_detail_ktra']?>"><?= $data_find_detai['ma_detail_ktra']?></option>
				    	<?php	}
				    	?>
				     </select>
			</div>
			<div class="form-group">
				<label>Nội dung:</label>
				<textarea  name="noi_dung" ><?php echo $data_bkt['noi_dung'];?></textarea> 

			</div>
			<div class="form-group">
				<label>Lời giải</label>
				<textarea  name="loi_giai" ><?php echo $data_bkt['loi_giai'];?></textarea> 
	
			</div>
			
			<input type="submit" name="btnSua" class="btn btn-primary" value="Sửa">
			<input type="reset" name="" class="btn btn-success" value="Làm mới">
		</form>
	</div>
</div>
</div>
<?php include 'Model/footer.php';?>
