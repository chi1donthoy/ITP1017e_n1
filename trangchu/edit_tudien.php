<?php include('header.php');
?>

<hr>
<div class="container">
	<div class="row">
            <div class="col-lg-6">
                <div class="col-md-9 col-md-offset-7">
                <div class="login-panel panel panel-primary ">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sửa từ mới</h3>
                    </div>
                    <div class="panel-body">
                    	<?php include('../Mysql/myconnect.php');?>
								
                    	<?php 
                    	$id = $_GET['id'];
                    	$sql_edit_tm = "SELECT *FROM kho_tu_moi WHERE id_tu_moi = $id";
                    	$query_edit_tm= mysqli_query($conn,$sql_edit_tm);
                    	$data_tm  = mysqli_fetch_array($query_edit_tm);
                    	
                    	?>
                        <form method="post" action="" enctype="multipart/form-data">
                        	<?php
                        	if(isset($_POST['btnSua'])){
                        		
                        			$english = $_POST['english'];
                        			$viet = $_POST['viet'];
                        
                        			if($_FILES['file']['name'] != NULL){
                        				if($_FILES['file']['type'] == "image/jpeg"
                        					||$_FILES['file']['type'] == "image/jpg"
                        					||$_FILES['file']['type'] == "image/png"
                        					||$_FILES['file']['type'] == "image/gif"){
                        						if($_FILES['file']['size']>1000000){
                        							echo "<p style='color:red'>File không quá 2MB</p>";
                        						}else{
                        							$name = $_FILES['file']['name'];
                        							//Xóa ảnh cũ khỏi file
                        							unlink("../upload/".$data_tm['hinh_anh']);
                        							//upload ảnh vào file
                        							move_uploaded_file($_FILES['file']['tmp_name'],"../upload/".$name);
                        							$sql_vocabulary = "UPDATE kho_tu_moi SET tu_moi ='$english',phien_am ='$viet',hinh_anh = '$name' WHERE id_tu_moi = $id ";
                        							mysqli_query($conn,$sql_vocabulary);
                        							echo "<div class='alert alert-success'>Sửa thành công!</div>";
                        						}
                        				}else{
                        					echo "<p style='color:red'>File không đúng định dạng!</p>";
                        				}
                        			}else{
                        				$name = $_POST['file1'];
                        				$sql_vocabulary = "UPDATE kho_tu_moi SET tu_moi ='$english',phien_am ='$viet',hinh_anh = '$name' WHERE id_tu_moi = $id ";
                        							mysqli_query($conn,$sql_vocabulary);
                        							echo "<div class='alert alert-success'>Sửa thành công!</div>";
                        			}
                        		
                        	}
                        	?>
                            <fieldset>
                                <div class="form-group">
                                    <label>English:</label>
                                    <input id="txtKey" class="form-control" placeholder="Nhập key" name="english" type="text" value="<?php echo $data_tm['tu_moi']?>">
                                   
                                </div>
                                <div class="form-group">
                                    <label>Việt:</label>
                                    <input type="text" id="btnAdd" class="form-control" placeholder="Tiếng Việt" name="viet" value="<?php echo $data_tm['phien_am']?>">
                                    
                               </div>   
                               <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="file" class="form-control" >
                                    <input type="hidden" name="file1" value="<?php echo $data_tm['hinh_anh'];?>">
                                </div>
                                <div class="form-group">
                                    
                                    <input type="submit" id="btnAdd" class="btn btn-lg btn-success btn-block" name="btnSua" value="Sửa & Lưu">
                               </div> 
                           </fieldset>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
  
</div>


	
</div>
<?php include('footer.php');?>