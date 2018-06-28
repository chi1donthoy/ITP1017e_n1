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
                $sql = "SELECT *FROM slider";
                $query = mysqli_query($conn,$sql);
                
              ?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                           <?php
                           while( $data = mysqli_fetch_array($query)){?>
                        <tr class="odd gradeX">
                            <td><?= $data['id_slider']?></td>
                            <td><?= $data['tieude_slider']?></td> 
                            <td><img width="100px" src="../upload/<?php echo $data['hinhanh']?>"></td>   
                            <td>
                                <?php
                                    if($data['trangthai']==1){
                                        echo "Hiển thị";
                                    }else{
                                        echo "Không hiển thị";
                                    }
                                ?>
                            </td>
                            <td align="center"><a href="edit_slider.php?id=<?php echo $data['id_slider']?>" with="20px;" class="btn btn-info">Sửa</a></td>
                            <td><a href="delete_slider.php?id=<?php echo $data['id_slider']?>"><img width="20px;" class="btn btn-danger">Xóa</a></td>
                                                                                                           
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