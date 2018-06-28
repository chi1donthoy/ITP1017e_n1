<?php ob_start(); ?>
<style type="text/css">
.required
{
	color:red;
}
</style>
<?php include('includes/header.php') ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
		<?php 
			include('../inc/myconnect.php');
			include('../inc/function.php');
			//Kiểm tra ID có phải là kiểu số không
			if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
			{
				$id=$_GET['id'];
			}
			else
			{
				header('Location: list_video.php');
				exit();
			}		
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$errors=array();
				if(empty($_POST['title']))
				{
					$errors[]='title';
				}
				else
				{
					$title=$_POST['title'];
				}
				if(empty($_POST['link']))
				{
					$errors[]='link';
				}	
				else
				{
					$link=$_POST['link'];
				}
				if(empty($_POST['ordernum']))
				{
					$ordernum=0;
				}	
				else
				{
					$ordernum=$_POST['ordernum'];
				}										
				$status=$_POST['status'];
				if(empty($errors))
				{
					$query="UPDATE tblvideo
							SET title='{$title}',
							    link='{$link}',
							    ordernum={$ordernum},
							    status={$status}
							WHERE
							  	id={$id} 
					";
					$results=mysqli_query($dbc,$query); 
					kt_query($results,$query);	
					if(mysqli_affected_rows($dbc)==1)
					{
						echo "<p style='color:green;'>Sửa thành công</p>";
					}
					else
					{
						echo "<p class='required'>Sửa không thành công</p>";	
					}								
				}
				else
				{
					$message="<p class='required'>Bạn hãy nhập đầy đủ thông tin</p>";
				}
			}
			$query_id="SELECT title,link,ordernum,status FROM tblvideo WHERE id={$id}";
			$result_id=mysqli_query($dbc,$query_id);
			kt_query($result_id,$query_id);
			//Kiểm tra xem ID có tồn tại không
			if(mysqli_num_rows($result_id)==1)
			{
				list($title,$link,$ordernum,$status)=mysqli_fetch_array($result_id,MYSQLI_NUM);
			}
			else
			{
				$message="<p class='required'>ID video không tồn tại</p>";	
			}
		?>
		<form name="frmadd_video" method="POST">
			<?php 
				if(isset($message))
				{
					echo $message;
				}
			?>
			<h3>Sửa Video: <?php if(isset($title)){ echo $title;} ?></h3>
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" value="<?php if(isset($title)){ echo $title;} ?>" class="form-control" placeholder="Title">
				<?php 
					if(isset($errors) && in_array('title',$errors))
					{
						echo "<p class='required'>Bạn chưa nhập tiêu đề</p>";
					}
				?>
			</div>
			<div class="form-group">
				<label>Link</label>
				<input type="text" value="<?php if(isset($link)){ echo $link;} ?>" name="link" class="form-control" placeholder="Video">
				<?php 
					if(isset($errors) && in_array('link',$errors))
					{
						echo "<p class='required'>Bạn chưa nhập link video</p>";
					}
				?>
			</div>
			<div class="form-group">
				<label>Thứ tự</label>
				<input type="text" value="<?php if(isset($ordernum)){ echo $ordernum;} ?>" name="ordernum" class="form-control" placeholder="Thứ tự">
			</div>
			<div class="form-group">
				<label style="display:block;">Trạng thái</label>
				<?php 
					if($status==1)
					{
					?>
					<label class="radio-inline"><input checked="checked" type="radio" name="status" value="1">Hiện thị</label>
					<label class="radio-inline"><input type="radio" name="status" value="0">Không hiện thị</label>
					<?php 
					}
					else
					{
					?>
					<label class="radio-inline"><input type="radio" name="status" value="1">Hiện thị</label>
					<label class="radio-inline"><input checked="checked" type="radio" name="status" value="0">Không hiện thị</label>
					<?php		
					}
				?>
			</div>
			<input type="submit" name="submit" class="btn btn-primary" value="Sửa video">
		</form>
	</div>
</div>
<?php include('includes/footer.php') ?>
<?php ob_flush(); ?>