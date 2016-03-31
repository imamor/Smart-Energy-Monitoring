<?php    
    $username = "smartpluguser"; 
    $password = "chris";   
    $host = "localhost";
    $database="smartplug";
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    $myquery = "SELECT  AVG(mincost)AS 'sum',AVG(Cost)AS 'sum2' FROM  `smartplug` ORDER BY date DESC LIMIT 60";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
 
  while ($row = mysql_fetch_assoc($query)) {
      $data = $row["sum"];
      $data1= $row["sum2"];
  }
      	$sql = 'INSERT INTO PowerCost '.
     		'(HourlyCost , HourlyRealKWH) '.
     		'VALUES ( '.$data.','.$data1.')';
$retval = mysql_query( $sql, $server );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
//echo "Entered data successfully\n";
mysql_close($server);
?>
