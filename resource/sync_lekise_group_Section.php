<meta charset="utf-8">
<?php
	session_start();
	include('_connect_srvsql.php');
	$srvsql		=	new	srvsql();
	$connect	=	$srvsql->connect();

	$sql		=	"
						SELECT		[COMID],
									[Division] as 'Section_code',
									[DivName] as 'Section_Name'
						FROM		[HRM].[dbo].[vw_employee]
						WHERE		[HRM].[dbo].[vw_employee].[TRNFlag]	=	'N'
						AND			(
										[HRM].[dbo].[vw_employee].[COMID]	=	'LKL'
										OR
										[HRM].[dbo].[vw_employee].[COMID]	=	'LKS'
										OR
										[HRM].[dbo].[vw_employee].[COMID]	=	'LKT'
										OR
										[HRM].[dbo].[vw_employee].[COMID]	=	'WTL'
									)
						AND			LEN([Division]) = 4
						GROUP BY	[COMID] , [Division] , [DivName]
						";
	$query		=	sqlsrv_query($connect, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	while($row	=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$sql_insert[]	=	"INSERT INTO [dbo].[section] ([company_Code],[section_Code],[section_Name]) VALUES ('".$row['COMID']."','".$row['Section_code']."','".$row['Section_Name']."')";
	}
	if(sqlsrv_begin_transaction($connect)===false){
		die('Transaction start = '.print_r(sqlsrv_errors(),true));
	}
	for($i=0;$i<=count($sql_insert);$i++)
	{
		$query_insert	.=	sqlsrv_query($connect,$sql_insert[$i]) or die( 'SQL Error = '.$sql_insert[$i].'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	}
	if($query_insert) {
		sqlsrv_commit($connect);
		$sql_changelog	=	"INSERT INTO [dbo].[changelog] ([changelog_user],[changelog_change],[changelog_where],[datenow]) VALUES ('".$_SESSION['user_Username']."','Sync Data Form Biosoft','Table section [".$company."]',GETDATE())";
		$query_insert	=	sqlsrv_query($connect,$sql_changelog) or die( 'SQL Error = '.$sql_changelog.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		echo "company [".$company."] Transaction committed.<br><br>";
	} else {
		sqlsrv_rollback($connect);
		echo "company [".$company."] Transaction rolled back.<br><br>";
	}
?>
<br>
<a href="index.php"> < Back </a>