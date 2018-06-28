<?php include 'Model/header.php';?>
<?php include '../Mysql/myconnect.php';?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách video</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách tài khoản
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                  <?php
                  //start bắt đầu bản ghi
                  //Limit số bản ghi lấy ra

                  //Đặt bản ghi cần hiển thị
                  $limit = 4;
                  //Xác định vị trí bắt đầu
                  if(isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_ranger'=>1))){
                  	$start = $_GET['s'];
                  }else{
                  	$start = 0;
                  }
                  if(isset($_GET['p']) && filter_var($_GET['p'],FILTER_VALIDATE_INT,array('min_ranger'=>1))){
                  	$per_page = $_GET['p'];
                  }else{
                  	// Nếu p không tồn tại thì sẽ truy vấn database tìm xem có bao nhiêu page
                  	$query_pg = "SELECT COUNT(id_admin) FROM user_admin";
                  	$result_pg = mysqli_query($conn,$query_pg);
                  	list($record)=mysqli_fetch_array($result_pg,MYSQLI_NUM);
                  	//Tìm số trang bằng cách chia số dữ liệu cho limit
                  	if($record > $limit){
                  		$per_page = ceil($record / $limit);
                  	}else{
                  		$per_page = 1;
                  	}
                  }
                  			$sql ="SELECT *FROM user_admin LIMIT {$start},{$limit}";
                  			$query = mysqli_query($conn,$sql);

                  ?>
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tài Khoản</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Điện Thoại</th>
                            <th>Quyền</th>                            
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                  <?php
                  while($data = mysqli_fetch_array($query)){


                  ?>
                    	<tr>
                            <td><?=$data['id_admin']?></td>
                            <td><?=$data['taikhoan']?></td>
                            <td><?=$data['ten']?></td>
                            <td><?=$data['email']?></td>
                            <td><?=$data['dienthoai']?></td>                           
                            <td><?php 
                            	if($data['quyen']==1){
                            		echo "Admin";
                            	}else{
                            		echo "Thường";
                            	}
                            ?></td>
                            <td align="center"><a href="edit_user_admin.php?id=<?php echo $data['id_admin'];?>" with="20px;"class="btn btn-info">Sửa</a></td>
                            <td><a href="delete_user_admin.php?id=<?php echo $data['id_admin'];?>"class="btn btn-danger">Xóa</a></td>
                        </tr>                                                                                   
                     <?php } ?>
                    </tbody>
                </table>
             <?php
             	echo "<ul class='pagination'>";
             	if($per_page > 1){
             		$curren_page = ($start / $limit)+1;
             		//Nêu không phải trang đầu thì hiển thị trang trước
             		if($curren_page != 1){
             			echo "<li><a href='list_user_admin.php?s=".($start-$limit)."&p={$per_page}'>Back</a></li>";
             		}
             		//Hiển thị những phần còn lại của trang
             		for($i=1;$i<=$per_page;$i++){
             			if($i != $curren_page){
             				echo "<li><a href='list_user_admin.php?s=".($limit*($i-1))."&p={$per_page}'>{$i}</a></li>";
             			}else{
             				echo "<li class='active'><a>{$i}</a></li>";
             			}
             		}
             		if($curren_page != $per_page){
             			echo "<li><a href='list_user_admin.php?s=".($limit+$start)."&p={$per_page}'>Next</a></li>";
             		}

             	}
             	echo "</ul>";
             ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php include 'Model/footer.php'; ?>