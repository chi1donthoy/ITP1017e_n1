<?php include 'Model/header.php';?>
<?php include '../Mysql/myconnect.php';?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách đề tài</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách đề tài
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tblDanhSach">
                      <?php
                            $sql_list_detai = "SELECT *FROM detail_kiemtra";
                            $query_list_detai = mysqli_query($conn,$sql_list_detai);
                      ?>
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên đề tài</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        while($data = mysqli_fetch_array($query_list_detai)){ ?>
                          <tr>
                              <td><?=$data['id_detail_ktra']?></td>
                              <td><?=$data['ma_detail_ktra']?></td>
                              <td align="center"><a href="edit_detai_kt.php?id=<?php echo $data['id_detail_ktra'];?>" with="20px;" class="btn btn-info">Sửa</a></td>
                              <td><a href="delete_detai_kt.php?id=<?php echo $data['id_detail_ktra'];?>" class="btn btn-danger">Xóa</a></td>
                          </tr>
                       <?php }
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