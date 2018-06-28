<?php include 'Model/header.php';?>
<?php include '../Mysql/myconnect.php';?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách truyện</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách truyện
            </div>

<?php function In($str,$skt=500,$kt="..."){
  $result = substr($str,0,$skt).$kt;
  echo $result;
 }?>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                      <?php

                  //start bắt đầu bản ghi
                  //Limit số bản ghi lấy ra

                  //Đặt bản ghi cần hiển thị
                  $limit = 3;
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
                        
                 
                            $sql_list_truyen = "SELECT *FROM truyen_songngu  LIMIT {$start},{$limit}";
                            $query_list_truyen = mysqli_query($conn,$sql_list_truyen);
                      ?>

                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên đề tài</th>
                            <th>Tóm tắt</th>
                            <th>Nội dung</th>
                            <th>Hình ảnh</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        while($data_truyen = mysqli_fetch_array($query_list_truyen)){
                        
                        $str = $data_truyen['noi_dung_truyen'];
 
 ?>
                          <tr>
                              <td><?=$data_truyen['id_truyen']?></td>
                              <td><?=$data_truyen['tieu_de']?></td>
                              <td><?=$data_truyen['tom_tat']?></td>
                              <td><?= In($str,500,"...")?></td>
                              <td><img src="../upload/<?=$data_truyen['hinh_anh']?> " width="100px;"></td>
                              
                              <td align="center"><a href="edit_truyen.php?id=<?php echo $data_truyen['id_truyen'];?>" with="20px;" class="btn btn-info">Sửa</a></td>
                              <td><a href="delete_truyen.php?id=<?php echo $data_truyen['id_truyen'];?>" class="btn btn-danger">Xóa</a></td>
                          </tr>
                       <?php }
                      ?>
       
                    </tbody>
                </table>
             <?php
                    echo "<ul class='pagination'>";
                    if($per_page >1){
                        $curent_page = ($start / $limit)+1;
                        //Không phải trang đầu thì hiển thị trang trc
                        if($curent_page !=1){
                            echo "<li><a href='list_truyen.php?s=".($start-$limit)."&p={$per_page}'>Back</a></li>";
                        }
                        for($i=1;$i<=$per_page;$i++){
                            if($i != $curent_page){
                                echo "<li><a href='list_truyen.php?s=".($limit*($i-1))."&p={$per_page}'>{$i}</a></li>";
                            }else{
                                    echo "<li class='active'><a>{$i}</a></li>";
                            }
                        }
                        if($curent_page != $per_page){
                        echo "<li><a href='list_truyen.php?s=".($limit+$start)."&p={$per_page}'>Next</a></li>";
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
<?php include 'Model/footer.php'; ?>