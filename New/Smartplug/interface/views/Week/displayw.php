<?php    
    $username = "smartpluguser"; 
    $password = "chris";   
    $host = "localhost";
    $database="smartplug";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    
    $myquery = "SELECT SUM(hourlycost)AS 'sumw' FROM  `currents`ORDER BY 'Date' DESC LIMIT 168  ";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
 
  while ($row = mysql_fetch_assoc($query)) {
      $data = $row["sumw"];
  }
    
    

    //echo $data;     
     session_start();
     $_SESSION['powercostw']=$data;
     echo $_SESSION['powercostw'];
	mysql_close($server);
?>
