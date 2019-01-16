<?php
class srvsql
{
	public function connect()
	{
		$serverName			=	"10.10.2.31";
		$connectionInfo		=	array(
										"Database"					=>	"master",
										"UID"						=>	"sa",
										"PWD"						=>	"P@ssw0rd",
										"MultipleActiveResultSets"	=>	true,
										"CharacterSet"				=>	'UTF-8',
										'ReturnDatesAsStrings'		=>	true
									);
		$connect	=	sqlsrv_connect($serverName,$connectionInfo);
		if(!$connect) {
			echo "<h1>Connection could not be established.</h1><hr><br />";
			die( '<pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		}
		else
		{
			return	$connect;
		}
	}
	public function query($sql)
	{
		$connect	=	$this->connect();
		$query		=	sqlsrv_query($connect,$sql) or die( 'SQL Error = '.$sql.'<hr><pre>'. print_r( sqlsrv_errors(), true) . '</pre>');
		$row		=	sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		return		$row;
	}
}
