<meta charset="utf-8">
<?php
	session_start();
	include('_connect_srvsql.php');
	$srvsql		=	new	srvsql();
	$connect	=	$srvsql->connect();

	$sql_Employees		=	"
							INSERT INTO [LeKise_Group].[dbo].[Employees]
							SELECT		emp3 as 'Employee2',
										COMID,
										Sectionn as 'Division',
										Department,
										Division as 'Section',
										ISNULL(Positionn, 0000 ),
										TitleEng,
										ISNULL(TitleThai, '' ),
										Name1,
										ISNULL(Name2, '' ),
										Lastname1,
										ISNULL(Lastname2, '' ),
										ISNULL(Email, '' ),
										EmployeeType,
										'',
										BirthDate,
										DateOfBirthYear,
										StartDate,
										'1'
							FROM		[10.10.2.11].[HRM].[dbo].[vw_employee]
							WHERE		TRNFlag = 'N'
							AND			LEN(emp3) = 8
							AND			(
										COMID	LIKE	'%LKS%'	OR
										COMID	LIKE	'%LKL%'	OR
										COMID	LIKE	'%WTL%'	OR
										COMID	LIKE	'%LKT%'	OR
										COMID	LIKE	'%OMP%'	
										)
							EXCEPT
							SELECT		[emp_code],
										[company_code],
										[division_code],
										[department_code],
										[section_code],
										[position_code],
										[emp_TName_TH],
										[emp_TName_EN],
										[emp_FName_TH],
										[emp_FName_EN],
										[emp_LName_TH],
										[emp_LName_EN],
										[emp_mail],
										[emp_type],
										'',
										[emp_birthdate],
										[emp_age],
										[emp_datestart],
										'1'
							FROM		[LeKise_Group].[dbo].[Employees]
							";
	$query_Employees	=	sqlsrv_query($connect, $sql_Employees, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )) or die( 'SQL Error = '.$sql_Employees.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
	if(sqlsrv_begin_transaction($connect)===false){
		die('Transaction start = '.print_r(sqlsrv_errors(),true));
	}
	if($query_Employees){
		sqlsrv_commit($connect);
		?>
		<div class="progress" style="margin-top: 1rem; margin-bottom: 1rem;">
			<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" aria-valuenow="<?php echo rand(0,100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo rand(0,100); ?>%"></div>
		</div>
		<?php
	}else{
		sqlsrv_rollback($connect);
		?>
		<div class="progress" style="margin-top: 1rem; margin-bottom: 1rem;">
			<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="<?php echo rand(0,100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo rand(0,100); ?>%"></div>
		</div>
		<?php
	}
?>
