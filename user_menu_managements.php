<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/switch.css">
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<link rel="stylesheet" href="css/addon.css">

	<link rel="icon" type="image/png" href="images/speedometer.png" />


	<title>Running Services</title>
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/addon.js"></script>
	<?php
	include('resource/_connect_srvsql.php');
	$srvsql		=	new	srvsql();
	$connect	=	$srvsql->connect();
	?>
</head>
<body>
	<div id="hnavs">
		<div class="navs">
			<div class="row row-fixed-0">
				<div class="col-4 text-center">
					<div class="titles">
						LeKise Innovation Running Services
					</div>
				</div>
				<div class="col-8 text-right">
					<div class="navs-right">
						<a class="btn btn-link btn-sm" href="#">
							<i class="far fa-comment-alt"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-content" id="hcontent">
		<div class="container-fluid">
			<div class="card">
				<div class="card-body" id="card-overflows" style="overflow: auto; height: 550px;">
				
					<div class="table-responsive" style="padding-top: 1%; padding-bottom: 1%;">
						<table class="table table-hover" id="datauser" style="width: 150%;">
							<thead>
								<tr>
								<?php
								$sql	=	"
											SELECT	*
											FROM	[LeKise_Group].[dbo].[Employees_Auth0_Application]
											";
								$stmt	=	sqlsrv_prepare( $connect, $sql );
								foreach( sqlsrv_field_metadata( $stmt ) as $fieldMetadata ) {
									echo '<th>'.$fieldMetadata['Name'].'</th>';
								}
								?>
							</tr>
							</thead>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div id="hfooter">
		<footer class="footer">
			<div class="row row-fixed-0">
				<div class="col-4 text-left">
					&nbsp;This page running time is : <span id="sec_runtime"></span>
				</div>
				<div class="col-4">
					LeKise Developer [ Innovations ] &copy; 2018 - <?php echo date('Y'); ?>
				</div>
				<div class="col-4 text-right">
					<span id="nowtime"></span>
				</div>
			</div>
		</footer>
	</div>
	<script language="javascript">

		var count		=	0;
        var timerVar	=	null;
		var	h			=	0;
		var	mins		=	0;
		var	startday	=	new Date();
		var	clockStart	=	startday.getTime();
		$(document).ready(function(){
			show();
			getSecs();
		});
		function getSecs() 
		{
			var nopointsec;
			var	intsec;
			var strsec		=	"";
			var	startday	=	new Date();
			var	myTime		=	new Date();
			var	timeNow		=	myTime.getTime();
			var	timeDiff	=	timeNow - clockStart;
			var	diffSecs	=	timeDiff/1000;
				intsec		=	diffSecs;
				nopointsec	=	intsec.toFixed(0);
			if(parseInt((timeDiff/1000).toFixed(0))	>	0	&&	parseInt((timeDiff/1000).toFixed(0))%60==0)
			{
				clockStart	=	startday.getTime();
				mins+=1;
				nopointsec	=	"00";
			}
			if(parseInt((timeDiff/1000).toFixed(0))	>	0	&&	parseInt((timeDiff/1000).toFixed(0))%3600==0)
			{
				h+=1;
			}
			window.setTimeout('getSecs()',1000); 
			$("#sec_runtime").html(" <i class='fas fa-spinner fa-pulse' style='color:#00FF94;'></i> " + pad(h.toFixed(0),2) + ":" + pad(mins.toFixed(0),2) + ":" + pad(nopointsec,2)  );
		}
		function show(){
			var d		=	new Date()
			var hours	=	pad(""+d.getHours(),2);
			var minutes	=	pad(""+d.getMinutes(),2);
			var seconds	=	pad(""+d.getSeconds(),2);
			$("#nowtime").html( hours + ":" + minutes + ":" + seconds + "&nbsp;");
			setTimeout("show()",1000)
		}
		function pad (str, max) {
			return str.length < max ? pad("0" + str, max) : str;
		}
	</script>

	<script type="text/javascript">
		var	Interval_sync_employees;
		var	click_sync_employees	=	1;
		var	uri_sync_employees		=	"resource/sync_lekise_group_Employees.php";
		$("#btn_sync_employees").click(function(){
			click_sync_employees	+=	1;
			if(click_sync_employees%2==0)
			{
				$('#status_sync_employees').html('<i class="far fa-laugh fa-spin fa-2x ok"></i>');
				$('#input_sync_employees').attr({'readonly' : 'readonly'});
				Interval_sync_employees	=	setInterval(function(){
												$.get(uri_sync_employees, function( data ){
													$('#show_sync_employees').html(data);
												});
											},$('#input_sync_employees').val());
			}
			else
			{
				clearInterval(Interval_sync_employees);
				$('#input_sync_employees').removeAttr('readonly');
				$('#status_sync_employees').html('<i class="far fa-frown fa-2x fail"></i>');
				$('#show_sync_employees').html('<hr>');
			}
		});
	</script>

	<script type="text/javascript">
		var	Interval_sync_employees_auth0;
		var	click_sync_employees_auth0	=	1;
		var	uri_sync_employees_auth0	=	"resource/sync_lekise_group_Employees_auth.php";
		$("#btn_sync_employees_auth0").click(function(){
			click_sync_employees_auth0	+=	1;
			if(click_sync_employees_auth0%2==0)
			{
				$('#status_sync_employees_auth0').html('<i class="far fa-laugh fa-spin fa-2x ok"></i>');
				$('#input_sync_employees_auth0').attr({'readonly' : 'readonly'});
				Interval_sync_employees_auth0	=	setInterval(function(){
												$.get( uri_sync_employees_auth0 , function( data ){
													$('#show_sync_employees_auth0').html(data);
												});
											},$('#input_sync_employees_auth0').val());
			}
			else
			{
				$('#input_sync_employees_auth0').removeAttr('readonly');
				$('#status_sync_employees_auth0').html('<i class="far fa-frown fa-2x fail"></i>');
				clearInterval(Interval_sync_employees_auth0);
			}
		});
	</script>

	<script type="text/javascript">
		var	Interval_sync_employees_login;
		var	click_sync_employees_login	=	1;
		var	uri_sync_employees_login	=	"resource/sync_lekise_group_Employees_login.php";
		$("#btn_sync_employees_login").click(function(){
			click_sync_employees_login	+=	1;
			if(click_sync_employees_login%2==0)
			{
				$('#status_sync_employees_login').html('<i class="far fa-laugh fa-spin fa-2x ok"></i>');
				$('#input_sync_employees_login').attr({'readonly' : 'readonly'});
				Interval_sync_employees_login	=	setInterval(function(){
												$.get( uri_sync_employees_login , function( data ){
													$('#show_sync_employees_login').html(data);
												});
											},$('#input_sync_employees_login').val());
			}
			else
			{
				$('#input_sync_employees_login').removeAttr('readonly');
				$('#status_sync_employees_login').html('<i class="far fa-frown fa-2x fail"></i>');
				clearInterval(Interval_sync_employees_login);
			}
		});
	</script>

</body>
</html>


									
