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
									FROM	[LeKise_Group].[dbo].[Employees_login]
									";
	$query_login				=	sqlsrv_query($connect, $sql_login, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )) or die( 'SQL Error = '.$sql_login.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	while($row_login			=	sqlsrv_fetch_array($query_login,SQLSRV_FETCH_ASSOC))
	{
		$sql_insert_login[]		=	"
									INSERT INTO [LeKise_Group].[dbo].[Employees_login]([emp_code],[emp_password])
									VALUES
									(
										'".$row_login['emp_code']."',
										'".strtoupper(MD5($row_login['emp_code']))."'
									)
									";
	}
	if(sqlsrv_begin_transaction($connect)===false){die('Transaction start = '.print_r(sqlsrv_errors(),true));}
	if(!empty($sql_insert_login))
	{
		for($i=0;$i<=count($sql_insert_login);$i++)
		{
			$query_insert_login	.=	sqlsrv_query($connect,$sql_insert_login[$i]) or die( 'SQL Error = '.$sql_insert_login[$i].'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		
		if($query_insert_login){
			sqlsrv_commit($connect);
			echo "Transaction employees committed.<br><br>";
		}else{
			sqlsrv_rollback($connect);
			echo "Transaction employees rolled back.<br><br>";
		}
	}




	$sql_login_manual			=	"
									SELECT	[emp_code]
									FROM	[LeKise_Group].[dbo].[Employees_manual]
									EXCEPT
									SELECT	[emp_code]
									FROM	[LeKise_Group].[dbo].[Employees_login]
									";
	$query_login_manual			=	sqlsrv_query($connect, $sql_login_manual, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )) or die( 'SQL Error = '.$sql_login_manual.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	while($row_login_manual		=	sqlsrv_fetch_array($query_login_manual,SQLSRV_FETCH_ASSOC))
	{
		$sql_insert_login_manual[]		=	"
									INSERT INTO [LeKise_Group].[dbo].[Employees_login]([emp_code],[emp_password])
									VALUES
									(
										'".$row_login_manual['emp_code']."',
										'".strtoupper(MD5($row_login_manual['emp_code']))."'
									)
									";
	}
	if(!empty($sql_insert_login_manual))
	{
		for($i=0;$i<=count($sql_insert_login_manual);$i++)
		{
			$query_insert_login_manual	.=	sqlsrv_query($connect,$sql_insert_login_manual[$i]) or die( 'SQL Error = '.$sql_insert_login_manual[$i].'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		
		if($query_insert_login_manual){
			sqlsrv_commit($connect);
			echo "Transaction employees committed.<br><br>";
		}else{
			sqlsrv_rollback($connect);
			echo "Transaction employees rolled back.<br><br>";
		}
	}

?>