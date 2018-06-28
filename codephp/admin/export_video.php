<?php 
include('../inc/myconnect.php');
include('../inc/function.php');
$query="SELECT * FROM tblvideo";
$results=mysqli_query($dbc,$query);
kt_query($results,$query);
if(mysqli_num_rows($results) >0)
{
	$output='
		<table class="table" border="1">
			<tr>
				<th colspan="4">Danh sách video</th>
			</tr>
			<tr>				    	
				<th>Title</th>
				<th>Link</th>
				<th>Thứ tự</th>
				<th>Trạng thái</th>
			</tr>
	';
	while($video_ex=mysqli_fetch_array($results,MYSQLI_ASSOC))
	{
		$output .='
			<tr>							
				<td>'.$video_ex["title"].'</td>
				<td>'.$video_ex["link"].'</td>
				<td>'.$video_ex["ordernum"].'</td>
				<td>'.$video_ex["status"].'</td>
			</tr>	
		';
	}
	$output .='</table>';
	header("Content-type : application/xls");
	header("Content-Disposition: attachment; filename=danhsachvideo.xls");
	echo $output;
}
?>