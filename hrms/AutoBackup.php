<?php
	session_start();
	set_time_limit(0);
	include("DBConnection.php");
	global $dbh;
	$path= explode("/", $_SERVER["PHP_SELF"]);
	$self = $_SERVER['PHP_SELF'];

	$dbh=mysql_connect (DB_HOST, DB_USERNAME, DB_PASSWORD) or die ('Could not connect to the database because: ' . mysql_error());
	mysql_select_db(DB_NAME);
	
	
		function backup_tables($host,$user,$pass,$name,$tables)
		{
			$return='';	
			$link = mysql_connect($host,$user,$pass);
			mysql_select_db($name,$link);
			
			//get all of the tables
			if($tables == '*')
			{
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result))
				{
					$tables[] = $row[0];
				}
			}
			else
			{
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}
			
			//cycle through
			$return.= 'SET AUTOCOMMIT=0;';
			$return.="\n";
			$return.= 'START TRANSACTION;';
			$return.="\n\n\n";
			foreach($tables as $table)
			{
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				
				$return.= 'DROP TABLE IF EXISTS '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysql_fetch_row($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = ereg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				$return.="\n\n\n";
			}
			$return.= 'COMMIT;';
			//save file
			// $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
			// fwrite($handle,$return);
			// fclose($handle);

			// header('Pragma: anytextexeptno-cache', true);
			// header("Pragma: public");
			// header("Expires: 0");
			// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			// header("Cache-Control: private", false);
			header("Content-Type: text/plain");
			header("Content-Disposition: attachment; filename=\"dbbackup_".date('DMY').(date('G')+3).date('ia').".sql\"");
			echo $return; exit();
			
		}
		
			backup_tables(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME,'*');
			//backup_tables('localhost','root','','project_management','*');
?>