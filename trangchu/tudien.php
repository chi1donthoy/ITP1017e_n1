<?php include('header.php');
if(isset($_SESSION['email'])){
 $email = $_SESSION['email'];
}
?>

<hr>
<div class="container">
	<div class="row">
            <div class="col-lg-6">
                <div class="col-md-9 col-md-offset-7">
                <div class="login-panel panel panel-primary ">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thêm Từ Mới</h3>
                    </div>
                    <div class="panel-body">
                    	<?php include('../Mysql/myconnect.php');?>

                    	<?php 
                    	$sql_find_tk = "SELECT *FROM user WHERE email = '$email'";
                    	$query_find_tk = mysqli_query($conn,$sql_find_tk);
                    	$data_find_tk  = mysqli_fetch_array($query_find_tk);
                    	
                    	$id_user = $data_find_tk['id_user'];
                    	?>
                        <form method="post" action="" enctype="multipart/form-data">
                        	<?php
                        	if(isset($_POST['btnThem'])){
                        		if(!empty($_POST['english']) && !empty($_POST['viet'])){
                        			$english = $_POST['english'];
                        			$viet = $_POST['viet'];

                        		}else{
                        			$err = array();
                        			if(empty($_POST['english'])){
                        				$err[]='english';
                        			}
                        			if(empty($_POST['viet'])){
                        				$err[]='viet';
                        			}
                        		}
                        		if(empty($err)){
                        			if($_FILES['file']['name'] != NULL){
                        				if($_FILES['file']['type'] == "image/jpeg"
                        					||$_FILES['file']['type'] == "image/jpg"
                        					||$_FILES['file']['type'] == "image/png"
                        					||$_FILES['file']['type'] == "image/gif"){
                        						if($_FILES['file']['size']>1000000){
                        							echo "<p style='color:red'>File không quá 2MB</p>";
                        						}else{
                        							$name = $_FILES['file']['name'];
                        							move_uploaded_file($_FILES['file']['tmp_name'],"../upload/".$name);
                        							$sql_vocabulary = "INSERT INTO kho_tu_moi (tu_moi,phien_am,hinh_anh,id_user) VALUES ('$english','$viet','$name','$id_user')";
                        							mysqli_query($conn,$sql_vocabulary);
                        						}
                        				}else{
                        					echo "<p style='color:red'>File không đúng định dạng!</p>";
                        				}
                        			}else{
                        				echo "<p style='color:red'>Bạn chưa chọn ảnh!</p>";
                        			}
                        		}
                        	}
                        	?>
                            <fieldset>
                                <div class="form-group">
                                    <label>English:</label>
                                    <input id="txtKey" class="form-control" placeholder="Nhập key" name="english" type="text" value="">
                                    <?php 
                                    	if(isset($err) && in_array('english',$err)){
                                    		echo "<p style='color:red'>Bạn chưa nhập từ mới!</p>";
                                    	}
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Việt:</label>
                                    <input type="text" id="btnAdd" class="form-control" placeholder="Tiếng Việt" name="viet" value="">
                                    <?php 
                                    	if(isset($err) && in_array('english',$err)){
                                    		echo "<p style='color:red'>Bạn chưa nhập từ mới!</p>";
                                    	}
                                    ?>
                               </div>   
                               <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="file" class="form-control" >
                                    
                                </div>
                                <div class="form-group">
                                    
                                    <input type="submit" id="btnAdd" class="btn btn-lg btn-success btn-block" name="btnThem" value="Thêm Từ Mới">
                               </div> 
                           </fieldset>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách từ mới
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
           

                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <?php
                        $limit = 5;
                        if(isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_ranger'=>1))){
                            $start = $_GET['s'];
                        }else{
                            $start = 0;
                        }
                        if(isset($_GET['p']) && filter_var($_GET['p'],FILTER_VALIDATE_INT,array('min_ranger'=>1))){
                            $per_page = $_GET['p'];
                        }else{
                            //Tìm xem trong database có bao nhiêu
                            $query_pg = "SELECT count(id_tu_moi) FROM kho_tu_moi";
                            $result_pg = mysqli_query($conn,$query_pg);
                            list($record) = mysqli_fetch_array($result_pg,MYSQLI_NUM);
                            //Tìm số trang xem có bao nhiêu trang
                            if($record > $limit){
                                $per_page = ceil($record / $limit);
                            }else{
                                $per_page = 1;
                            }
                        }
                            $ds_tu_moi = "SELECT *FROM kho_tu_moi WHERE id_user = $id_user LIMIT {$start},{$limit}";
                            $query_tu_moi = mysqli_query($conn,$ds_tu_moi);
                    ?>
                    <thead >
                        <tr>
                            <th>Mã</th>
                            <th>Tiếng anh</th>
                            <th>Tiếng việt</th>
                            <th>Hình ảnh</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$i=1;
                    	while($danhsach = mysqli_fetch_array($query_tu_moi)){
                        		?>

                    	<tr>
 							<td><?=($i++)?></td>
                        	<td><?=$danhsach['tu_moi']?></td>
                        	<td><?=$danhsach['phien_am']?></td>
                        	<td style="text-align: center;"><img src="../upload/<?=$danhsach['hinh_anh']?>" width="100px;" height="100px"></td>
                        	<td><a href="edit_tudien.php?id=<?php echo $danhsach['id_tu_moi'];?>" class="btn btn-info btn-block">Sửa</a></td>
                        	<td><a href="delete_tudien.php?id=<?php echo $danhsach['id_tu_moi'];?>" class="btn btn-danger btn-block">Xóa</a></td>
                        </tr>
								
                    <?php 	}
                    	?>
                       
                    </tbody>
                </table>
                <?php
                    echo "<ul class='pagination'>";
                    if($per_page >1){
                        $curent_page = ($start / $limit)+1;
                        //Không phải trang đầu thì hiển thị trang trc
                        if($curent_page !=1){
                            echo "<li><a href='tudien.php?s=".($start-$limit)."&p={$per_page}'>Back</a></li>";
                        }
                        for($i=1;$i<=$per_page;$i++){
                            if($i != $curent_page){
                                echo "<li><a href='tudien.php?s=".($limit*($i-1))."&p={$per_page}'>{$i}</a></li>";
                            }else{
                                    echo "<li class='active'><a>{$i}</a></li>";
                            }
                        }
                        if($curent_page != $per_page){
                        echo "<li><a href='tudien.php?s=".($limit+$start)."&p={$per_page}'>Next</a></li>";
                    }
                    }
                    echo "<ul>";
                ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
</div>


	
</div>
<?php include('footer.php');?>