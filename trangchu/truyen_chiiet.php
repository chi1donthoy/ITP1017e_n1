<?php include('header.php');
require_once '../Mysql/myconnect.php';

if(isset($_SESSION['email'])){
 $email = $_SESSION['email'];
}
?>

<br>
<hr>
<br>
<div class="container">
	<div class="row">
				<?php
					$id = $_GET['id'];
					$sql_truyen_nd = "SELECT *FROM truyen_songngu WHERE id_truyen = $id";
					$query_truyen_nd = mysqli_query($conn,$sql_truyen_nd);
					$ds_truyen_nd = mysqli_fetch_assoc($query_truyen_nd);
					$sql_user = "SELECT *FROM user WHERE email = '$email'";
					$query_user = mysqli_query($conn,$sql_user);
					$dl_user = mysqli_fetch_assoc($query_user);
					$id_us = $dl_user['id_user'];
					$sql_tu_moi = "SELECT *FROM kho_tu_moi WHERE id_user = $id_us";
					$query_tu_moi = mysqli_query($conn,$sql_tu_moi);
					$dl_tm = mysqli_fetch_all($query_tu_moi);
					/*echo "<pre>";
					print_r($dl_tm );*/
					$x2 = $ds_truyen_nd['noi_dung_truyen'];
					$x1 = $ds_truyen_nd['tieu_de'];
					
					$ds ='<div class="row">
										<div class="col-sm-11">
										
											<p>'.$x2.'</p>	
										</div> 
      							</div>
      							<hr>'?>
				
				<div class="col-sm-12" >
					<form method="post">
					 <div class="panel panel-info">
      						<div class="panel-heading">Danh sách truyện</div>
      						<div class="panel-body">
      							<input type="submit" name="btnDich" value="Dịch văn bản" class="btn btn-info">  
      							 <div class="row">
										<div class="col-sm-11">
											<h3><?php echo $x1?></h3>
											<p>
												<?php
      							if(isset($_POST['btnDich'])){
      								foreach($dl_tm as $key =>$value){
      								    $str1 = $value['1'];
      								    $str2 = $value['2'];
      								  /* echo "<pre>";
      								    print_r($value);*/
      								    $x2 = str_replace($str2,"<a style='color:red' title='$str2'>$str1</a>",$x2);
      								}
      								echo $x2;
      								/*echo "<pre>";
      								print_r($value);*/
      								
      							}else{
      								echo $ds;
      							}

      							?>             
											</p>	
										</div> 
      							</div>
      							<hr>		                                
      
   					 </div>
					        
				</div>	
			</form>
	</div>		
</div>
</div>
<?php include('footer.php');?>