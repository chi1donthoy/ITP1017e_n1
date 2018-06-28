<?php 
	$idTin=$_GET['idTin'];	
	$idTin1=explode('-',$idTin);
	$id=$idTin1[0];	
	if(isset($id) && filter_var($id,FILTER_VALIDATE_INT,array('min_range'=>1)))
	{
	include('inc/myconnect.php');
	//include('includes/slider.php');
	$sql="SELECT * FROM tblbaiviet WHERE id={$id}";
	$query_a=mysqli_query($dbc,$sql);
	$dm_info=mysqli_fetch_assoc($query_a);
	$sql2="SELECT * FROM tbldanhmucbaiviet WHERE id={$dm_info['danhmucbaiviet']}";
	$query_a2=mysqli_query($dbc,$sql2);
	$dm_info2=mysqli_fetch_assoc($query_a2);
	$view_add=$dm_info['view'] + 1;
	$query="UPDATE tblbaiviet SET view={$view_add} WHERE id={$id}";
	$results=mysqli_query($dbc,$query);
	kt_query($results,$query);
	$sql3="SELECT * FROM tblbaiviet WHERE id={$id}";
	$query_a3=mysqli_query($dbc,$sql3);
	$dm_info3=mysqli_fetch_assoc($query_a3);
	?>	
			<div class="box_center">
				<div class="box_center_top">
					<div class="box_center_top_l"><a href="tinbycategory.php?dm=<?php echo $dm_info2['id']; ?>" title="<?php echo $dm_info2['danhmucbaiviet']; ?>"><?php echo $dm_info2['danhmucbaiviet']; ?></a></div>
					<div class="box_center_top_r"></div>
					<div class="clearfix"></div>
				</div>
				<div class="box_center_main">
					<ul class="breadcrumb">
						<li><a href="<?php echo BASE_URL; ?>" title="Trang chủ"><i class="fa fa-home"></i></a></li>
						<li><a href="tinbycategory.php?dm=<?php echo $dm_info2['id']; ?>" title="<?php echo $dm_info2['danhmucbaiviet']; ?>"><?php echo $dm_info2['danhmucbaiviet']; ?></a></li>
						<li class="active"><?php echo $dm_info['title']; ?></li>
					</ul>
					<div class="baiviet_ct">
						<h1><?php echo $dm_info['title']; ?></h1>
						<div id="time">
							<?php 
								$ng_dang=explode('-',$dm_info['ngaydang']);
								$ngaydang_ct=$ng_dang[2].'-'.$ng_dang[1].'-'.$ng_dang[0];
							?>
							Ngày đăng:&nbsp;<?php echo $ngaydang_ct; ?> | <?php echo $dm_info['giodang']; ?> | <?php echo $dm_info3['view']; ?> lượt xem
						</div>
						<div class="p"><?php echo $dm_info['noidung']; ?></div>	
						<div class="tin_row">
							<p>Gửi ý kiến</p>
							<br>
							<div id="show2"><label>Cám ơn bạn đã gớp ý</label></div>
							<div id="show1">
								<form id="button" name="frmform" method="POST">
							<table>
								<input type="hidden" name="idbv" id="idbv" value="<?php echo $dm_info['id']; ?>">
								<tr>
									<td>Họ tên</td>
								</tr>
								<tr>
									<td><input type="text" name="hoten" id="hoten" value=""></td>
								</tr>
								<tr>
									<td>Điện thoại</td>
								</tr>
								<tr>
									<td><input type="text" name="dienthoai" id="dienthoai" value=""></td>
								</tr>
								<tr>
									<td>Địa chỉ</td>
								</tr>
								<tr>
									<td><input type="text" name="diachi" id="diachi" value=""></td>
								</tr>
								<tr>
									<td>Email</td>
								</tr>
								<tr>
									<td><input type="text" name="email" id="email" value=""></td>
								</tr>
								<tr>
									<td>Nội dung</td>
								</tr>
								<tr>
									<td><textarea name="noidung" id="noidung"></textarea></td>
								</tr>
								<tr>									
									<td><input type="submit" name="submit" value="Gửi ý kiến"></td>
								</tr>	
							</table>
							</form>
							</div>
							<br>
							<script type="text/javascript">
								$(document).ready(function(){
									$("#show2").hide();
									function checkMail(mail){
					                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;								
					                    if (!filter.test(mail)) return false;								
					                        return true;								
					                }
									$("#button").submit(function(){
										var idbv=$("#idbv").val();
										var hoten=$("#hoten").val();
										var dienthoai=$("#dienthoai").val();
										var diachi=$("#diachi").val();
										var email=$("#email").val();
										var noidung=$("#noidung").val();
										if(hoten=='')
										{
											alert("Bạn chưa nhập họ tên");
											$("#hoten").focus();
											return false;
										}
										else if(dienthoai=='')
										{
											alert("Bạn chưa nhập điện thoại");
											$("#dienthoai").focus();
											return false;	
										}
										else if(diachi=='')
										{
											alert("Bạn chưa nhập địa chỉ");
											$("#diachi").focus();
											return false;	
										}
										else if(email=='')
										{
											alert("Bạn chưa nhập email");
											$("#email").focus();
											return false;	
										}
										else if(!checkMail(email))
										{
											alert("Email không đúng định dạng (xyz@abc.de)");
											$("#email").focus();
											return false;	
										}
										else if(noidung=='')
										{
											alert("Bạn chưa nhập nội dung");											
											return false;	
										}
										else
										{
											$.ajax({
												type: "POST",
												url: "dogopy.php",
												data: {idbv : idbv,hoten : hoten,dienthoai : dienthoai,diachi : diachi,email : email,noidung : noidung},
												cache: false,
												success:function(html){
													$("#show1").hide(500);
													$("#show2").show(500);
												}
											});
										}
										return false;
									});
								});
							</script>
						</div>																				
						<div class="tin_row">
							<p>Tin liên quan</p>
							<ul>
								<?php 
									$query_lq="SELECT * FROM tblbaiviet WHERE id!={$dm_info['id']} AND danhmucbaiviet={$dm_info['danhmucbaiviet']} ORDER BY ordernum DESC LIMIT 0,8";
									$result_lq=mysqli_query($dbc,$query_lq);
									while($tinlq=mysqli_fetch_array($result_lq,MYSQLI_ASSOC))
									{
									?>
									<li><a href="<?php echo $tinlq['id'] ?>-<?php echo LocDau($tinlq['title']); ?>.html" title="<?php echo $tinlq['title']; ?>"><?php echo $tinlq['title']; ?></a></li>
									<?php		
									}
								?>								
							</ul>
						</div>
						<div class="tin_row">
							<p>Tin xem nhiều</p>
							<ul>
								<?php 
									$query_xn="SELECT * FROM tblbaiviet ORDER BY view DESC LIMIT 0,8";
									$result_xn=mysqli_query($dbc,$query_xn);
									while($tinxn=mysqli_fetch_array($result_xn,MYSQLI_ASSOC))
									{
									?>
									<li><a href="<?php echo $tinxn['id'] ?>-<?php echo LocDau($tinxn['title']); ?>.html" title="<?php echo $tinxn['title']; ?>"><?php echo $tinxn['title']; ?></a></li>
									<?php		
									}
								?>
							</ul>
						</div>
						<div class="tin_row">
							<p>Tin ngẫu nhiên</p>
							<ul>
							<?php 
								$query_random="SELECT * FROM tblbaiviet ORDER BY rand() LIMIT 0,8";
								$result_rd=mysqli_query($dbc,$query_random);
								while($tinrd=mysqli_fetch_array($result_rd,MYSQLI_ASSOC))
								{
								?>
								<li><a href="<?php echo $tinrd['id'] ?>-<?php echo LocDau($tinrd['title']); ?>.html"><?php echo $tinrd['title']; ?></a></li>
								<?php	
								}
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>
<?php 
}
else
{
	header('Location:index.php');
	exit();
}
?>					