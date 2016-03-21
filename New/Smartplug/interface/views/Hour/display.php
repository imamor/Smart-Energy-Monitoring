<?php    
    $username = "smartpluguser"; 
    $password = "chris";   
    $host = "localhost";
    $database="smartplug";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    
    $myquery = "SELECT  * FROM  `currents`ORDER BY 'Date' DESC LIMIT 1  ";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
 
  while ($row = mysql_fetch_assoc($query)) {
      $data = $row["hourlycost"];
  }
    
    

    //echo $data;     
     session_start();
     $_SESSION['powercost']=$data;
     echo $_SESSION['powercost'];
	mysql_close($server);
?>
