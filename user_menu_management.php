<? session_start(); ?>
<?
if(empty($_SESSION[user_ID]))
{
	echo "<script>window.location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title></title>

		<link	rel="stylesheet"	type="text/css"	href="css/core/bootstrap.css">
		<link	rel="stylesheet"	type="text/css"	href="css/core/font-awesome.css">
		<link	rel="stylesheet"	type="text/css"	href="css/libs/nanoscroller.css"/>
		<link	rel="stylesheet"	type="text/css"	href="css/compiled/theme_styles.css">
		<link	rel="stylesheet"	type="text/css"	href="css/compiled/addon.css">
		<link	rel="stylesheet"	type="text/css"	href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400'>
		
		<link	rel="stylesheet"	type="text/css"	href="css/libs/jquery.dataTables.css">

		<script	src="js/core/jquery-1.12.4.min.js"></script>
		<script	src="js/core/bootstrap.js"></script>
		<script	src="js/scripts.js"></script>
		<script	src="js/pace.min.js"></script>

		<script	src="js/jquery.dataTables.js"></script>

	</head>
<body>
	<? include('@connect.php'); ?>
	<? include('nav-start.php'); ?>



	
	<div class="table-responsive" style="padding-top: 1%; padding-bottom: 1%;">
		<table class="table table-hover" id="datauser" style="width: 150%;">
			<thead>
				<tr>
					<th>รูปภาพ</th>
					<th>หน่วยงาน</th>
					<th>ชื่อผู้ใช้ระบบ</th>
					<?
					if($_SESSION[user_LV]	==	9)
					{
						?>
						<th>Password</th>
						<?
					}
					?>
					<th class="col-md-4">ชื่อ-นามสกุล</th>
					<th>Menu1</th>
					<th>Menu2</th>
					<th>Menu3</th>
					<th>Menu4</th>
					<th>Menu5</th>
					<th>Menu6</th>
					<th>Menu7</th>
					<th>Menu8</th>
					<th>Menu9</th>
					<th>Menu10</th>
					<th>Menu11</th>
					<th>Menu12</th>
				</tr>
			</thead>
			<tbody>
				<?
				$status	=	"";
				$sql	=	"
							SELECT	*
							FROM	user
							INNER JOIN	department	ON	department.Dep_ID	=	user.Dep_ID
							";
				$query	=	mysql_query($sql) or die(mysql_error());
				while($row	=	mysql_fetch_array($query)){
					?>
					<tr>
						<td style="width: 20px" align="center"><img class="img-datatable-user" src="img/user/<?=$row[user_img]?>" alt=""/></td>
						<td style="width: 100px"><?=$row[Dep_Name]?></td>
						<td style="width: 100px"><?=$row[user_username]?></td>
						<?
						if($_SESSION[user_LV]	==	9)
						{
							?>
							<td><a class="btn btn-link" href="system/changepassword.php?act=lostpassword&id=<?=$row[user_ID]?>" onclick="return confirm('เปลี่ยนรหัสผ่าน ?');">Reset</a></td>
							<?
						}
						?>
						<td><?=$row[user_TName].' '.$row[user_FName].' '.$row[user_LName]?></td>
						<?
							$sql_menu	=	"
											SELECT	*
											FROM	user_menu
											WHERE	user_ID	=	'".$row[user_ID]."'
											";
							$query_menu	=	mysql_query($sql_menu) or die(mysql_error());
							while($row_menu	=	mysql_fetch_array($query_menu))
							{
								?>
								<td>
									<?
									if($row_menu[menu_1]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=1&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=1&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_2]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=2&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=2&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_3]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=3&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=3&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_4]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=4&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=4&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_5]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=5&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=5&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_6]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=6&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=6&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_7]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=7&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=7&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?

									if($row_menu[menu_8]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=8&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=8&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_9]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=9&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=9&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_10]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=10&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=10&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_11]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=11&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=11&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<td>
									<?
									if($row_menu[menu_12]	==	1)
									{
										?>
										<a class="btn btn-success" href="system/changeactivemenu.php?act=inactive&menu=12&id=<?=$row[user_ID]?>" onclick="return confirm('ปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-check"></i></a>
										<?
									}
									else
									{
										?>
										<a class="btn btn-danger" href="system/changeactivemenu.php?act=active&menu=12&id=<?=$row[user_ID]?>" onclick="return confirm('เปิดการใช้งานเมนู สำหรับ <?=$row[user_username]?> ?');"><i class="fa fa-times"></i></a>
										<?
									}
									?>
								</td>
								<?
							}
						?>
						
					</tr>
					<?
				}
				?>
			</tbody>
		</table>
	</div>

	<? include('nav-end.php'); ?>




	<script	src="js/demo-skin-changer.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#datauser').dataTable({
				"order": [[ 0, "desc"]] ,
				"sPaginationType": "full_numbers",
				"lengthMenu": [[10, 25, 50, 100], [10, 25, 50, "All"]],
				"iDisplayLength": 50,
			});
		});
	</script>
</body>
</html>