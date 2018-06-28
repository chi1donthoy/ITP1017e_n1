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
                    $sql_ds_user = "SELECT *FROM user";
                    $query_ds_user = mysqli_query($conn,$sql_ds_user);
                   
                   ?>
                    <thead>
                     
                        <tr>
                            <th>Mã</th>
                            <th>Email</th>
                            <th>Điện thoại</th>       
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        while( $ds_user = mysqli_fetch_array($query_ds_user)){?>
                          <tr>
                            <td><?= $ds_user['id_user']?></td>
                            <td><?= $ds_user['email']?></td>
                            <td><?= $ds_user['dienthoai']?></td>
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