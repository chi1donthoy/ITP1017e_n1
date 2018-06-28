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
                Danh sách bài kiểm tra
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
             <?php
                    $sql_bai_kt = "SELECT *FROM bai_kiem_tra";
                    $query_bai_kt = mysqli_query($conn,$sql_bai_kt);
                    $sql_detai_kt = "SELECT *FROM detail_kiemtra";
                    $query_detai_kt = mysqli_query($conn,$sql_detai_kt);

             ?>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên bài kiểm tra</th>
                            <th>Nội dung</th>
                            <th>Lời giải</th>
                            <th>Đề tài</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                          <?php
                            while($data = mysqli_fetch_array($query_bai_kt)){
                                $data1 = mysqli_fetch_array($query_detai_kt);
                                ?>

                                <tr class="odd gradeX">
                                    <td><?=$data['id_bai_ktra']?></td>
                                    <td><?=$data['ma_bai_ktra']?></td> 
                                    <td><?=$data['noi_dung']?></td>   
                                    <td><?=$data['loi_giai']?></td>
                                    <td><?=$data['id_detail_ktra']?></td>
                                    <td align="center"><a href="edit_bai_kt.php?id=<?php echo $data['id_bai_ktra']?>" with="20px;" class="btn btn-info"></a></td>
                                    <td><a href="delete_bai_kt.php?id=<?php echo $data['id_bai_ktra']?>"><img width="20px;" class="btn btn-danger"></a></td>                                                                                                               
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