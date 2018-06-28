<?php include('header.php');
require_once '../Mysql/myconnect.php';
?>
<br>
<hr>
<br>
<div class="container">

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
                    $query_pg = "SELECT COUNT(id_truyen) FROM truyen_songngu  ";
                    $result_pg = mysqli_query($conn,$query_pg);
                    list($record)=mysqli_fetch_array($result_pg,MYSQLI_NUM);
                    //Tìm số trang bằng cách chia số dữ liệu cho limit
                    if($record > $limit){
                      $per_page = ceil($record / $limit);
                    }else{
                      $per_page = 1;
                    }
                  }
                        
					$sql_truyen = "SELECT *FROM truyen_songngu LIMIT {$start},{$limit}";
					$query_truyen = mysqli_query($conn,$sql_truyen);					
				?>
				<div class="col-sm-12" >
					 <div class="panel panel-info">
      						<div class="panel-heading">Danh sách truyện</div>
      						<div class="panel-body">
      							<?php
      						while($ds_truyen = mysqli_fetch_array($query_truyen)){?>
 
                                 <div class="row">
      									<div class="col-sm-3">
											<img src="../upload/<?= $ds_truyen['hinh_anh']?>" width="250px" height="260px">
										</div>
										<div class="col-sm-9">
											<h3><?= $ds_truyen['tieu_de']?></h3>
											<p><?= $ds_truyen['tom_tat']?></p>
											<p><a href="truyen_chiiet.php?id=<?php echo $ds_truyen['id_truyen'];?>">Chi Tiết >></a></p>
										</div> 
      							</div>
      							<hr>
      							<?php	}
      							?>
      							
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

					        
				</div>	
	</div>		
</div>
</div>
<?php include('footer.php');?>