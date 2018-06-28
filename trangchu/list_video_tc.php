<?php include('header.php');
require_once '../Mysql/myconnect.php';
?>
<br>
<hr>
<br>
<div class="container video">
	
<div class="row">
	<h3 class="S_title">Học tiếng anh qua video</h3>
	<div class="col-sm-12" >
		<?php
		   //start bắt đầu bản ghi
                  //Limit số bản ghi lấy ra

                  //Đặt bản ghi cần hiển thị
                  $limit = 12;
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
                    $query_pg = "SELECT COUNT(id_video) FROM video ";
                    $result_pg = mysqli_query($conn,$query_pg);
                    list($record)=mysqli_fetch_array($result_pg,MYSQLI_NUM);
                    //Tìm số trang bằng cách chia số dữ liệu cho limit
                    if($record > $limit){
                      $per_page = ceil($record / $limit);
                    }else{
                      $per_page = 1;
                    }
                  }
		$sql_video = "SELECT *FROM video  LIMIT {$start},{$limit}";
		$quert_video = mysqli_query($conn,$sql_video);
		
	while($data_video = mysqli_fetch_array($quert_video)){?>
 
                                <div class="col-sm-3">
						<div class="work">
							<h4><?php echo $data_video['tieude']?></h4>
							<a href="#" class="work_img">
							<iframe width="100%" height="320px" class="embed-player" src="<?= $data_video['linkvideo'];?>" frameborder="0" allowfullscreen></iframe>
							</a>
			
						</div>
					</div>		
      							
      							<?php	}
      							?>
      					
	</div>		
	               
</div>
				 <?php
                    echo "<ul class='pagination'>";
                    if($per_page >1){
                        $curent_page = ($start / $limit)+1;
                        //Không phải trang đầu thì hiển thị trang trc
                        if($curent_page !=1){
                            echo "<li><a href='list_video_tc.php?s=".($start-$limit)."&p={$per_page}'>Back</a></li>";
                        }
                        for($i=1;$i<=$per_page;$i++){
                            if($i != $curent_page){
                                echo "<li><a href='list_video_tc.php?s=".($limit*($i-1))."&p={$per_page}'>{$i}</a></li>";
                            }else{
                                    echo "<li class='active'><a>{$i}</a></li>";
                            }
                        }
                        if($curent_page != $per_page){
                        echo "<li><a href='list_video_tc.php?s=".($limit+$start)."&p={$per_page}'>Next</a></li>";
                    }
                    }
                    echo "<ul>";
                ?>	
				
</div>

<?php include('footer.php');?>
	