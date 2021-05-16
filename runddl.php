<?php
	require_once('config.php');

	if (ENABLE_RUNDDL!="true") die('runddl disabled');

	require_once('sys/sql.php');
	require_once('sys/util.php');

	class ddl_helper extends sql {

		function __construct($sql) {
       		$this->sql = $sql;
    	}

		function run_ddl() {
    		$dbdump = file_get_contents(RUNDDL_DBDUMP_FILENAME);
			if (!$dbdump) die('failed to read the DDL dump file '.RUNDDL_DBDUMP_FILENAME);
			$dbdump_statements = explode(';', $dbdump);
			foreach ($dbdump_statements as $sql_statement) {
				print ("exec $sql_statement... ");
				$result = $this->sql->doSQL($sql_statement);
				print ("result $result;<br>
");
			}
			print("<p>all done</p>");
		}
	}

	if (RUNDDL_PASSWORD != $_GET['RUNDDL_PASSWORD']) {
		sleep(1);
		die("Not authorized");
	}

	$sql = new sql(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASS, MYSQL_DB);
	$ddl_helper = new ddl_helper( $sql );
	$ddl_helper->run_ddl();
?>DDL imported!
