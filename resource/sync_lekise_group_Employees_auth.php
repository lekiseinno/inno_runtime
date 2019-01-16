<meta charset="utf-8">
<?php
	session_start();
	include('_connect_srvsql.php');
	$srvsql						=	new	srvsql();
	$connect					=	$srvsql->connect();
	$sql_login					=	"
									SELECT	[emp_code]
									FROM	[LeKise_Group].[dbo].[Employees]
									EXCEPT
									SELECT	[emp_code]
									FROM	[LeKise_Group].[dbo].[Employees_Auth0_Application]
									";
	$query_login				=	sqlsrv_query($connect, $sql_login, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )) or die( 'SQL Error = '.$sql_login.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	while($row_login			=	sqlsrv_fetch_array($query_login,SQLSRV_FETCH_ASSOC))
	{
		$sql_insert_auth[]		=	"
									INSERT INTO [LeKise_Group].[dbo].[Employees_Auth0_Application] ([emp_code],[auth_MyLeKise],[auth_Eleave],[auth_SO_LKT],[auth_SO_WTL],[auth_COA_LFB],[auth_COA_OM])
									VALUES
									(
										'".$row_login['emp_code']."',
										'1',
										'1',
										'0',
										'0',
										'0',
										'0'
									);
									";
	}	
	if(sqlsrv_begin_transaction($connect)===false){die('Transaction start = '.print_r(sqlsrv_errors(),true));}
	if(!empty($sql_insert_auth))
	{
		for($i=0;$i<=count($sql_insert_auth);$i++)
		{
			$query_insert_login	.=	sqlsrv_query($connect,$sql_insert_auth[$i]) or die( 'SQL Error = '.$sql_insert_auth[$i].'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		if($query_insert_login){
			sqlsrv_commit($connect);
			echo "Transaction employees committed.<br><br>";
		}else{
			sqlsrv_rollback($connect);
			echo "Transaction employees rolled back.<br><br>";
		}
	}

	$sql_login_m				=	"
									SELECT	[emp_code]
									FROM	[LeKise_Group].[dbo].[Employees_manual]
									EXCEPT
									SELECT	[emp_code]
									FROM	[LeKise_Group].[dbo].[Employees_Auth0_Application]
									";
	$query_login_m				=	sqlsrv_query($connect, $sql_login_m, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )) or die( 'SQL Error = '.$sql_login_m.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	while($row_login_m			=	sqlsrv_fetch_array($query_login_m,SQLSRV_FETCH_ASSOC))
	{
		$sql_insert_auth_m[]		=	"
									INSERT INTO [LeKise_Group].[dbo].[Employees_Auth0_Application] ([emp_code],[auth_MyLeKise],[auth_Eleave],[auth_SO_LKT],[auth_SO_WTL],[auth_COA_LFB],[auth_COA_OM])
									VALUES
									(
										'".$row_login_m['emp_code']."',
										'1',
										'1',
										'0',
										'0',
										'0',
										'0'
									);
									";
	}	

	if(!empty($sql_insert_auth_m))
	{
		for($i=0;$i<=count($sql_insert_auth_m);$i++)
		{
			$query_insert_login_m	.=	sqlsrv_query($connect,$sql_insert_auth_m[$i]) or die( 'SQL Error = '.$sql_insert_auth_m[$i].'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		if($query_insert_login_m){
			sqlsrv_commit($connect);
			echo "Transaction employees committed.<br><br>";
		}else{
			sqlsrv_rollback($connect);
			echo "Transaction employees rolled back.<br><br>";
		}
	}

?>
<br>