<?php
session_start();
require_once '../Mysql/myconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">

    <title>Đăng Nhập</title>
<!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.csss" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form  action="" method="POST">
                      <?php
                            if(isset($_POST['btnDN'])){
                                $taikhoan = $_POST['taikhoan'];
                                $matkhau  = md5($_POST['matkhau']);
                                if(!empty($_POST['taikhoan']) && !empty($_POST['taikhoan'])){

                                }else{
                                    $err = array();
                                    if(empty($_POST['taikhoan'])){
                                        $err[] = 'taikhoan';
                                    }
                                    if(empty($_POST['matkhau'])){
                                        $err[] = 'matkhau';
                                    }

                                }
                                if(empty($err)){
                                    $sql = "SELECT taikhoan,matkhau FROM user_admin WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhau' ";
                                    $query = mysqli_query($conn,$sql);
                                    if($data = mysqli_num_rows($query)==1){
                                        $_SESSION['taikhoan']=$taikhoan;
                                        header('Location:index.php');
                                    
                                    }else{
                                        echo "<p stlyle='color:red'>*Tài khoản hoặc mật khẩu không đúng*</p>";
                                    }
                                    
                                }
                            }
                      ?>
                            <fieldset>
                                <div class="form-group">
                                	<label>Tài khoản:</label>
                                    <input class="form-control" placeholder="E-mail" name="taikhoan" value="<?php if(isset($_POST['taikhoan'])){echo $_POST['taikhoan'];}?>">
                               <?php
                                    if(isset($err) && in_array('taikhoan',$err)){
                                        echo "<p style='color:red'>*Bạn chưa nhập tài khoản!</p>";
                                    }
                               ?>
                                </div>
                                <div class="form-group">
                                	<label>Mật Khẩu:</label>
                                    <input class="form-control" placeholder="Password" name="matkhau" type="password" >
                                <?php
                                    if(isset($err) && in_array('matkhau',$err)){
                                        echo "<p style='color:red'>*Bạn chưa nhập mật khẩu!</p>";
                                    }
                               ?>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="btnDN">Đăng nhập</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>
         
</body>

</html>
