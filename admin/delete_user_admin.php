<?php
 require_once '../Mysql/myconnect.php';
  $id = $_GET['id'];
  $sql = "DELETE FROM user_admin WHERE id_admin = $id";
  mysqli_query($conn,$sql);
  header('Location:list_user_admin.php');
?>