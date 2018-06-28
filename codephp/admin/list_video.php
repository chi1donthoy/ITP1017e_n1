<?php 
ob_start();
include('includes/header.php'); ?>
<?php include('../inc/myconnect.php') ?>
<?php include('../inc/function.php') ?>
<script type="text/javascript">
	$(document).ready(function(){
		//check / uncheck tất cả bản ghi
		$(document).on('change','#check_all',function(){
			$('.checkitem').prop('checked',this.checked).trigger('change');
		});
		//check / uncheck từng bản ghi
		$(document).on('change','.checkitem',function(){
			var dem_r = 0;
			var checked_r = 1;
			//Duyệt tất cả các checktem
			$('.checkitem').each(function(){
				if($(this).is(':checked'))
				{
					dem_r++;
				}
				else
				{
					checked_r = 0;
				}
			});
			$('#check_all').prop('checked',checked_r);
			if(dem_r > 0)
			{
				$('#delete_all').show(0.5);
			}
			else
			{
				$('#delete_all').hide(0.5);	
			}
		});
	});
</script>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Danh sách video</h3>
		<?php 
			if(isset($_POST['submit']))
			{
				$query="DELETE FROM tblvideo WHERE id IN(".implode(',',$_POST['id']).")";
				$result=mysqli_query($dbc,$query);
				kt_query($result,$query);
				header('Location: list_video.php');
			}
		?>
		<form name="frmdanhsachvd" method="POST">			
			<table class="table table-hover">
				<thead>
					<tr>
						<th><input type="checkbox" id="check_all" name="check_all"></th>
						<th>Mã</th>
						<th>Title</th>
						<th>Link</th>
						<th>Thứ tự</th>
						<th>Trạng thái</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$query="SELECT * FROM tblvideo ORDER BY ordernum DESC";
						$result=mysqli_query($dbc,$query);
						kt_query($result,$query);
						while($video=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
						{
						?>
						<tr>
							<td><input type="checkbox" class="checkitem" name="id[]" value="<?php echo $video['id']; ?>"></td>
							<td><?php echo $video['id']; ?></td>
							<td><?php echo $video['title']; ?></td>
							<td><?php echo $video['link']; ?></td>
							<td><?php echo $video['ordernum']; ?></td>
							<td>
								<?php 							
								if($video['status']==1)
								{
									echo 'Hiện thị';
								} 
								else
								{
									echo 'Không hiện thị';
								}
								?>
							</td>
							<td align="center"><a href="edit_video.php?id=<?php echo $video['id']; ?>"><img width="16" src="../images/icon_edit.png"></a></td>
							<td align="center"><a onclick="return confirm('Bạn có thật sự muốn xóa không');" href="delete_video.php?id=<?php echo $video['id']; ?>"><img width="16" src="../images/icon_delete.png"></a></td>
						</tr>
						<?php
						}
					?>				
				</tbody>
				<tfoot>
					<td colspan="8">
						<input style="display:none;" id="delete_all" type="submit" name="submit" class="btn" value="Xóa chọn">
					</td>
				</tfoot>
			</table>
		</form>	
		<a href="export_video.php" class="btn btn-success">Export To Excel</a>			
		<a href="import_video.php" class="btn btn-primary">Import dữ liệu</a>
	</div>
</div>
<?php include('includes/footer.php'); 
ob_flush();
?>