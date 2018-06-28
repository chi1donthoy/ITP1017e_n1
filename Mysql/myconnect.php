<?php
 $conn = mysqli_connect('localhost','root','','app_english') or die('Kết nối không thành công');
 mysqli_set_charset($conn,'utf8');
  /*if(isset($conn)){
  	echo "Kết nối thành công";
  }else{
  	echo "Kết nối không thành công";
  }*/