<?php 
include('includes/header.php');
include('../inc/myconnect.php');
include('../inc/function.php');
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Import dữ liệu từ file Excel</h3>
		<form name="import" method="POST" enctype="multipart/form-data">
			<input type="file" name="file">
			<br>
			<input type="submit" name="submit" value="Import">
		</form>
		<?php 
			if(isset($_POST['submit']))
			{				
				$data=array();
				if($_FILES['file']['tmp_name'])
				{					
					$dom = DOMDocument::load($_FILES['file']['tmp_name']);
					$rows = $dom->getElementsByTagName('Row');
					$first_row = true;
					foreach ($rows as $row) 
					{
						if(!$first_row)
						{
							$index = 1;
							$cells = $row->getElementsByTagName('Cell');
							foreach ($cells as $cell) 
							{
								$ind = $cell->getAttribute('Index');
								if($ind != null) $index = $ind;
								if($index == 1)
									$title = $cell->nodeValue;
								if($index == 2)
									$link = $cell->nodeValue;
								if($index == 3)
									$ordernum = $cell->nodeValue;
								if($index == 4)
									$status = $cell->nodeValue;								
								$index++;					
							}							
							$data[]=array(
								'title'	=>$title,
								'link'	=>$link,
								'ordernum'	=>$ordernum,
								'status'	=>$status
							);							
						}
						$first_row = false;
					}
				}				
				if($data)
				{
					$dem_tt=1;
					foreach ($data as $row) 
					{
						if($dem_tt>1)
						{
							$a1=$row['title'];						
							$a2=$row['link'];
							$a3=$row['ordernum'];							
							$a4=$row['status'];	
							$query="INSERT INTO tblvideo(title,link,ordernum,status)
							VALUES('{$a1}','{$a2}',$a3,$a4)";
							$results=mysqli_query($dbc,$query);
							kt_query($results,$query);
						}
						$dem_tt++;
					}
					echo "<p style='color:green;'>Import thành công</p>";
					echo "<p><a href='list_video.php'>Quay lại trang list</a></p>";
				}				
			}
		?>
	</div>
</div>
<?php
include('includes/footer.php');
?>