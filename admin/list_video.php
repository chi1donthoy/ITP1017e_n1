<?php include 'Model/header.php';?>
<?php include '../Mysql/myconnect.php'; ?>
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
                Danh sách video
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <?php
                $sql = "SELECT *FROM video";
                $query = mysqli_query($conn,$sql);
                
              ?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tiêu đề</th>
                            <th>Link</th>
                            <th>Nội Dung</th>
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                           <?php
                           while( $data = mysqli_fetch_array($query)){?>
                        <tr class="odd gradeX">
                            <td><?= $data['id_video']?></td> 
                            <td><?= $data['tieude']?></td>
                            <td><?= $data['linkvideo']?></td>
                            <td><?= $data['noidung']?></td>
                            <td>
                                <?php
                                    if($data['trangthai']==1){
                                        echo "Hiển thị";
                                    }else{
                                        echo "Không hiển thị";
                                    }
                                ?>
                            </td>
                            <td align="center"><a href="edit_video.php?id=<?php echo $data['id_video']?>" with="20px;" class="btn btn-info">Sửa</a></td>
                            <td><a href="delete_video.php?id=<?php echo $data['id_video']?>" class="btn btn-danger">Xóa</a></td>
                                                                                                           
                        </tr>
                         <?php  }
                           ?>
                        
                        
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php include 'Model/footer.php'; ?>