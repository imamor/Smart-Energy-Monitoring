<?php    
    $username = "smartpluguser"; 
    $password = "chris";   
    $host = "localhost";
    $database="smartplug";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    $myquery = "SELECT  AVG(mincost)AS 'sum' FROM  `smartplug` ORDER BY date DESC LIMIT 60";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
 
  while ($row = mysql_fetch_assoc($query)) {
      $data = $row["sum"];
  }
    
    

    //echo json_encode($data); 
    //echo $data;
 

	$sql = 'INSERT INTO currents '.
     		'(hourlycost) '.
     		'VALUES ( '.$data.')';
     
$retval = mysql_query( $sql, $server );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
//echo "Entered data successfully\n";
mysql_close($server);
?>
